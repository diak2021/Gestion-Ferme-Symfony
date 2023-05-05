<?php

namespace App\Controller;

use App\Entity\SiteWeb;
use App\Form\SiteWebType;
use App\Repository\SiteWebRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth/site/web")
 */
class SiteWebController extends AbstractController
{
    /**
     * @Route("/", name="site_web_index", methods={"GET"})
     */
    public function index(SiteWebRepository $siteWebRepository): Response
    {
        return $this->render('site_web/index.html.twig', [
            'site_webs' => $siteWebRepository->findBy([], ['id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/new", name="site_web_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $siteWeb = new SiteWeb();
        $form = $this->createForm(SiteWebType::class, $siteWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($siteWeb);
            $entityManager->flush();

            $this->addFlash('success', '✔ Enregistrement effectué avec succès !');
            return $this->redirectToRoute('site_web_index');
        }

        return $this->render('site_web/new.html.twig', [
            'site_web' => $siteWeb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="site_web_show", methods={"GET"})
     */
    public function show(SiteWeb $siteWeb): Response
    {
        return $this->render('site_web/show.html.twig', [
            'site_web' => $siteWeb,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="site_web_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SiteWeb $siteWeb): Response
    {
        $form = $this->createForm(SiteWebType::class, $siteWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('site_web_index');
        }

        return $this->render('site_web/edit.html.twig', [
            'site_web' => $siteWeb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="site_web_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SiteWeb $siteWeb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$siteWeb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($siteWeb);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('site_web_index');
    }
}
