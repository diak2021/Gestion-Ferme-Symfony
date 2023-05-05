<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\AnneeRepository;
use App\Repository\NewsletterRepository;
use App\Repository\ParametresRepository;
use App\Repository\SiteWebRepository;
use App\Service\Helper;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/newsletter")
 */
class NewsletterController extends AbstractController
{
    /**
     * @Route("/", name="newsletter_index", methods={"GET"})
     */
    public function index(NewsletterRepository $newsletterRepository): Response
    {
        return $this->render('newsletter/index.html.twig', [
            'newsletters' => $newsletterRepository->findBy([], ['id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/new", name="newsletter_new", methods={"GET","POST"})
     */
    public function new(\Swift_Mailer $mailer, Request $request, SiteWebRepository $siteWebRepository, NewsletterRepository $newsletterRepository, AnneeRepository $anneeRepository, ParametresRepository $parametresRepository): Response
    {

        if ($request->getMethod() == "POST" && $request->get('email')) {
            $newsletter = $newsletterRepository->findOneBy(['email'=>$request->get('email')]);

            if (!is_object($newsletter)){
                $entityManager = $this->getDoctrine()->getManager();
                $newsletter = new Newsletter();
                $newsletter->setEmail($request->get('email'));
                $newsletter->setSiteWeb($siteWebRepository->find(1));
                $newsletter->setCreatedAt(new \DateTime('now'));
                $newsletter->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));

                $entityManager->persist($newsletter);
                $entityManager->flush();

                $parametre = $parametresRepository->findOneBy(['siteWeb'=>1]);

                if ($parametre->getEmailToAdminAfterNewAddNewsletter()){
                    /** Alerte de mail entrant pour l'admin */

                    $message = (new \Swift_Message("Nouvelle Inscription à la newsletter"))
                        ->setFrom('mamoudout560@gmail.com')
                        ->setTo($parametre->getEmail())
                        ->setBody(
                            $this->renderView(
                                'envoiEmail/notifNewsletter.html.twig',
                                [
                                    'news' => $newsletter,
                                    'parametre'=>$parametre
                                ]
                            ),
                            'text/html'
                        )
                    ;

                    try {
                        $result = $mailer->send($message);
                    }catch (\Swift_TransportException $e){
                        $this->json(['erreur'=>$e]);
                    }catch (\Exception $e){
                        $this->json(['erreur'=>$e]);
                    }
                }

                if($parametre->getEmailToClientAfterNewAddNewsletter()){
                    /** Accusé de reception pour le visiteur ayant envoyé le mail */

                    $message = (new \Swift_Message('Inscription réussie'))
                        ->setFrom('mamoudout560@gmail.com')
                        ->setTo($newsletter->getEmail())
                        ->setBody(
                            $this->renderView(
                                'envoiEmail/accuseReceptionNewsletter.html.twig',
                                [
                                    'news' => $newsletter,
                                    'parametre'=>$parametre
                                ]
                            ),
                            'text/html'
                        )
                    ;
                    $mailer->send($message);
                }
            }

            return $this->json('ok');
        }

        return $this->render('newsletter/new.html.twig');
    }

    /**
     * @Route("/{id}", name="newsletter_show", methods={"GET"})
     */
    public function show(Newsletter $newsletter): Response
    {
        return $this->render('newsletter/show.html.twig', [
            'newsletter' => $newsletter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="newsletter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Newsletter $newsletter): Response
    {
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');

            return $this->redirectToRoute('newsletter_index');
        }

        return $this->render('newsletter/edit.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newsletter_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Newsletter $newsletter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsletter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsletter);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('newsletter_index');
    }
}
