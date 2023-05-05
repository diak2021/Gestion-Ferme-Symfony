<?php

namespace App\Controller;

use App\Entity\Email;
use App\Form\EmailType;
use App\Repository\AnneeRepository;
use App\Repository\EmailRepository;
use App\Repository\ParametresRepository;
use App\Repository\SiteWebRepository;
use App\Service\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/email")
 */
class EmailController extends AbstractController
{
    /**
     * @Route("/", name="email_index", methods={"GET"})
     */
    public function index(EmailRepository $emailRepository): Response
    {
        return $this->render('email/index.html.twig', [
            'emails' => $emailRepository->findBy(['isMailEntrant'=>true], ['isLu'=>"DESC", 'id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/nouveaus/mails", name="nouveaux_mails", methods={"GET"})
     */
    public function nouveaux_mails(EmailRepository $emailRepository): Response
    {
        return $this->render('email/index.html.twig', [
            'emails' => $emailRepository->findBy(['isMailEntrant'=>true, 'isLu'=>false], ['id'=>"DESC"]),
            'new_mails'=>true
        ]);
    }

    /**
     * @Route("/new", name="email_new", methods={"GET","POST"})
     */
    public function new(\Swift_Mailer $mailer,Request $request, ParametresRepository $parametresRepository, SiteWebRepository $siteWebRepository, AnneeRepository $anneeRepository): Response
    {

        if ($request->getMethod() == "POST" && $request->get('email')) {

            $entityManager = $this->getDoctrine()->getManager();
            $parametre = $parametresRepository->findOneBy(['siteWeb'=>1]);

            $email = new Email();
            $email->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $email->setObjet($request->get('objet'));
            $email->setEmailReceiver($parametre->getEmail());
            $email->setEmailSender($request->get('email'));
            $email->setEmetteur($this->getUser());
            $email->setCorps($request->get('message'));
            $email->setCreatedAt(new \DateTime('now'));
            $email->setIsMailEntrant(true);
            $email->setIsMailSortant(false);
            $email->setIsLu(false);
            $email->setNom($request->get('nom'));
            $email->setSiteWeb($siteWebRepository->find(1));

            $entityManager->persist($email);
            $entityManager->flush();

            if($parametre->getEmailToAdminAfterNewMailing()){
                /** Alerte de mail entrant pour l'admin */

                $objet = "Nouveau mail du site ". $parametre->getLibelleStructure();
                if ($request->get('objet') != "") $objet = $email->getObjet();

                $message = (new \Swift_Message($objet))
                    ->setFrom('mamoudout560@gmail.com')
                    ->setTo($parametre->getEmail())
                    ->setBody(
                        $this->renderView(
                            'envoiEmail/notifEmail.html.twig',
                            [
                                'email' => $email,
                                'parametre'=>$parametre
                            ]
                        ),
                        'text/html'
                    )
                ;
                $mailer->send($message);
            }

            if($parametre->getEmailToClientAfterNewMailing()){
                /** Accusé de reception pour le visiteur ayant envoyé le mail */

                $message = (new \Swift_Message('Accusé de réception'))
                    ->setFrom('mamoudout560@gmail.com')
                    ->setTo($email->getEmailSender())
                    ->setBody(
                        $this->renderView(
                            'envoiEmail/accuseReceptionEmail.html.twig',
                            [
                                'email' => $email,
                                'parametre'=>$parametre
                            ]
                        ),
                        'text/html'
                    )
                ;
                $mailer->send($message);
            }

            return $this->json(['data'=>'ok']);
        }

        return $this->render('email/new.html.twig');
    }

    /**
     * @Route("/{id}", name="email_show", methods={"GET"})
     */
    public function show(Email $email): Response
    {
        if (! $email->getIsLu()){
            $email->setIsLu(true);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($email);
            $manager->flush();
        }

        return $this->render('email/show.html.twig', [
            'email' => $email,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="email_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Email $email): Response
    {
        $form = $this->createForm(EmailType::class, $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('email_index');
        }

        return $this->render('email/edit.html.twig', [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="email_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Email $email): Response
    {
        if ($this->isCsrfTokenValid('delete'.$email->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($email);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('email_index');
    }

    /**
     * @Route("/{id}/reply", name="email_reply", methods={"GET", "POST"})
     */
    public function email_reply(\Swift_Mailer $mailer, Request $request, ParametresRepository $parametresRepository, Email $email, SiteWebRepository $siteWebRepository, AnneeRepository $anneeRepository): Response
    {
        if ($request->getMethod() == "POST"){
            $entityManager = $this->getDoctrine()->getManager();
            $parametre = $parametresRepository->findOneBy(['siteWeb'=>1]);

            $new_email = new Email();
            $new_email->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $new_email->setObjet('Re: '. $email->getObjet());
            $new_email->setEmailReceiver($email->getEmailSender() );
            $new_email->setEmailSender($parametre->getEmail());
            $new_email->setEmetteur($this->getUser());
            $new_email->setCorps(trim($request->get('corps')));
            $new_email->setCreatedAt(new \DateTime('now'));
            $new_email->setIsMailEntrant(false);
            $new_email->setIsMailSortant(true);
            $new_email->setIsLu(false);
            $new_email->setEmailRepondu($email);
            $new_email->setNom($this->getUser()->getUsername());
            $new_email->setSiteWeb($siteWebRepository->find(1));

            $email->addReponse($new_email);
            $email->setIsLu(true);

            $entityManager->persist($email);
            $entityManager->persist($new_email);
            $entityManager->flush();

            /** Envoie du mail */

            $objet = $new_email->getObjet();

            $message = (new \Swift_Message($objet))
                ->setFrom('mamoudout560@gmail.com')
                ->setTo($new_email->getEmailReceiver())
                ->setBody(
                    $new_email->getCorps(),
                    'text/html'
                )
            ;
            $mailer->send($message);

            $this->addFlash('success', 'Email répondu avec succès!');
            return $this->redirectToRoute('email_index');
        }

        return $this->render('email/reply.html.twig', [
            'email'=>$email,
        ]);
    }

}
