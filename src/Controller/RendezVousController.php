<?php

namespace App\Controller;

use App\Entity\Email;
use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\AnneeRepository;
use App\Repository\ParametresRepository;
use App\Repository\RendezVousRepository;
use App\Repository\ServiceRepository;
use App\Repository\SiteWebRepository;
use App\Repository\TeamMemberRepository;
use App\Service\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/rendez/vous")
 */
class RendezVousController extends AbstractController
{
    /**
     * @Route("/", name="rendez_vous_index", methods={"GET"})
     */
    public function index(RendezVousRepository $rendezVousRepository): Response
    {
        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rendezVousRepository->findBy([], ['isLu'=> "ASC", 'isRepondu'=>"ASC", 'id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/new", name="rendez_vous_new", methods={"GET","POST"})
     */
    public function new(Request $request, Helper $helper, \Swift_Mailer $mailer, SiteWebRepository $siteWebRepository, AnneeRepository $anneeRepository, TeamMemberRepository $teamMemberRepository, ServiceRepository $serviceRepository, ParametresRepository $parametresRepository): Response
    {
        if ($request->getMethod() == "POST" && $request->get('email')) {

            $entityManager = $this->getDoctrine()->getManager();

            /** @var $rendezVou
             *Creation d'un nouveau rendez-vous
            */
            $rendezVou = new RendezVous();
            $rendezVou->setIsActif(true);
            $rendezVou->setIsLu(false);
            $rendezVou->setHasTakenPlace(false);
            $rendezVou->setIsAnnuler(false);
            $rendezVou->setIsConfirmer(false);
            $rendezVou->setIsReamenager(false);
            $rendezVou->setIsRepondu(false);
            $rendezVou->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $rendezVou->setCreatedAt(new \DateTime('now'));
            $rendezVou->setDateRendezVous(new \DateTime($request->get('date')));
            $rendezVou->setHeureRendezVous(new \DateTime($request->get('time')));
            $rendezVou->setEmail($request->get('email'));
            $rendezVou->setNom($request->get('name'));
            $rendezVou->setTelephone($request->get('phone'));
            $rendezVou->setDetail($request->get('message'));
            $rendezVou->setSiteWeb($siteWebRepository->find(1));
            if ($request->get('doctor')) $rendezVou->setConsultant($teamMemberRepository->find($request->get('doctor')));
            if ($request->get('department'))$rendezVou->setService($serviceRepository->find($request->get('department')));

            $entityManager->persist($rendezVou);
            $entityManager->flush();

            $parametre = $parametresRepository->findOneBy(['siteWeb'=>1]);

            if($parametre->getEmailToAdminAfterNewRDV()){
                /** Envoi de mail de notification à l'admin */

                $message = (new \Swift_Message('Nouvelle demande de rendez-vous'))
                    ->setFrom('mamoudout560@gmail.com')
                    ->setTo($parametre->getEmail())
                    ->setBody(
                        $this->renderView(
                            'envoiEmail/notifRendezVous.html.twig',
                            [
                                'rendezVous' => $rendezVou,
                                'parametre'=>$parametre
                            ]
                        ),
                        'text/html'
                    )
                ;
                $mailer->send($message);
            }
            if($parametre->getEmailToClientAfterNewRDV()){
                /** Accusé de reception pour le visiteur ayant envoyé le mail */

                $message = (new \Swift_Message('Accusé de réception'))
                    ->setFrom('mamoudout560@gmail.com')
                    ->setTo($rendezVou->getEmail())
                    ->setBody(
                        $this->renderView(
                            'envoiEmail/accuseReceptionRDV.html.twig',
                            [
                                'rendezVous' => $rendezVou,
                                'parametre'=>$parametre
                            ]
                        ),
                        'text/html'
                    )
                ;
                $mailer->send($message);
            }

            /** Envoi de texto d'alerte à l'admin */
            if ($parametre->getSmsToAdminAfterNewRDV() and $helper->prepareNumber($parametre->getTelephone())){
                $sms = "Bonjour, vous avez reçu une demande de rendez-vous pour le " .
                        $rendezVou->getDateRendezVous()->format('d/m/Y'). ' à '.
                        $rendezVou->getHeureRendezVous()->format('h:i').
                        '. Vous plus de détail connectez-vous à l\'application sur le '.
                        'https://hospitalsight.com'
                    ;
                $helper->SendSms($helper->prepareNumber($parametre->getTelephone()), $sms);
            }

            /** envoi de texto accusant reception au visiteur */
            if ($parametre->getSmsToClientAfterNewRDV() and $helper->prepareNumber($rendezVou->getTelephone())){
                $sms = "Bonjour, vous avez sollicité un rendez-vous pour le " .
                    $rendezVou->getDateRendezVous()->format('d/m/Y'). ' à '.
                    $rendezVou->getHeureRendezVous()->format('h:i').
                    '. Nous vous reviendrons dans les plus brefs délais pour une confirmation. Merci!'
                ;
               $helper->SendSms($helper->prepareNumber($rendezVou->getTelephone()), $sms);
            }

            return $this->json(['resultat'=>'super']);
        }

        return $this->redirectToRoute('rendez_vous_index');
    }

    /**
     * @Route("/{id}", name="rendez_vous_show", methods={"GET"})
     */
    public function show(RendezVous $rendezVou): Response
    {
        if (!$rendezVou->getIsLu()){
            $rendezVou->setIsLu(true);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($rendezVou);
            $manager->flush();
        }
        return $this->render('rendez_vous/show.html.twig', [
            'rendez_vou' => $rendezVou,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rendez_vous_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RendezVous $rendezVou): Response
    {
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/edit.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendez_vous_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RendezVous $rendezVou): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezVou->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendezVou);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('rendez_vous_index');
    }

    /**
     * @Route("/nouveaux/rendezvous", name="new_rendez_vous", methods={"GET"})
     */
    public function nouveaux_rendez_vous(RendezVousRepository $rendezVousRepository): Response
    {

        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rendezVousRepository->findBy(['isLu'=> false], [ 'isRepondu'=>"ASC", 'id'=>"DESC"]),
            'new_rdv'=>true,
        ]);
    }


    /**
     * @Route("/{id}/reply", name="rdv_reply", methods={"GET", "POST"})
     */
    public function rdv_reply(\Swift_Mailer $mailer, Request $request, ParametresRepository $parametresRepository, RendezVous $rendezVous, SiteWebRepository $siteWebRepository, AnneeRepository $anneeRepository): Response
    {
        if ($request->getMethod() == "POST"){
            $entityManager = $this->getDoctrine()->getManager();
            $parametre = $parametresRepository->findOneBy(['siteWeb'=>1]);

            $new_email = new Email();
            $new_email->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $new_email->setObjet(trim($request->get('objet')));
            $new_email->setEmailReceiver($rendezVous->getEmail());
            $new_email->setEmailSender($parametre->getEmail());
            $new_email->setEmetteur($this->getUser());
            $new_email->setCorps(trim($request->get('corps')));
            $new_email->setCreatedAt(new \DateTime('now'));
            $new_email->setIsMailEntrant(false);
            $new_email->setIsMailSortant(true);
            $new_email->setIsLu(false);
            $new_email->setRendezVousRepondu($rendezVous);
            $new_email->setNom($this->getUser()->getUsername());
            $new_email->setSiteWeb($siteWebRepository->find(1));

            $rendezVous->setIsLu(true);
            $rendezVous->setIsRepondu(true);
            $rendezVous->addEmailsReponse($new_email);

            $entityManager->persist($rendezVous);
            $entityManager->persist($new_email);
            $entityManager->flush();

            /** Envoie du mail */

            $objet = $new_email->getObjet();
            if ($objet == "") $objet = "Ré: Demande de rendez-vous";

            $message = (new \Swift_Message($objet))
                ->setFrom('mamoudout560@gmail.com')
                ->setTo($new_email->getEmailReceiver())
                ->setBody(
                    $new_email->getCorps(),
                    'text/html'
                )
            ;
            $mailer->send($message);

            $this->addFlash('success', 'Rendez-vous répondu avec succès!');
            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/reply.html.twig', [
            'rdv'=>$rendezVous,
        ]);
    }


}
