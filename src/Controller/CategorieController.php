<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\AnneeRepository;
use App\Repository\CategorieRepository;
use App\Repository\SiteWebRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth/categorie")
 */
class CategorieController extends AbstractController
{

    /**
     * @Route("/new", name="categorie_index", methods={"GET","POST"})
     */
    public function new(Request $request, CategorieRepository $categorieRepository, AnneeRepository $anneeRepository, SiteWebRepository $siteWebRepository): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $categorie->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $categorie->setSiteWeb($siteWebRepository->find(1));
            $categorie->setCreatedAt(new \DateTime('now'));
            $categorie->setCreatedBy($this->getUser());

            $entityManager->persist($categorie);
            $entityManager->flush();

            $this->addFlash('success', '✔ Enregistrement effectué avec succès !');
            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/index.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
            'categories' => $categorieRepository->findBy([], ['id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_show", methods={"GET"})
     */
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('categorie_index');
    }
}
