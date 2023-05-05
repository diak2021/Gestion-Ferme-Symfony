<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\ProductionType;
use App\Repository\AnneeRepository;
use App\Repository\CategorieRepository;
use App\Repository\ProductionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/production")
 */
class ProductionController extends AbstractController
{
    /**
     * @Route("/", name="production_index", methods={"GET"})
     */
    public function index(ProductionRepository $productionRepository, CategorieRepository $categorieRepository): Response
    {
        $production = new Production();
        $form = $this->createForm(ProductionType::class, $production);

        $prixOeufDefault = $categorieRepository->find(1)->getPrixUnitaireParDefaut();

        return $this->render('production/index.html.twig', [
            'form'=>$form->createView(),
            'productions' => $productionRepository->findAll(),
            'prixOeufDefaut'=> $prixOeufDefault,
        ]);
    }

    /**
     * @Route("/new", name="production_new", methods={"GET","POST"})
     */
    public function new(Request $request, AnneeRepository $anneeRepository, ProductionRepository $productionRepository, CategorieRepository $categorieRepository): Response
    {
        $production = new Production();
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $production_du_jour = $productionRepository->findOneBy(['date'=>$production->getDate()]);

            if (is_object($production_du_jour)){ /** si la production du jour est déjà faite on enregistre pas */
                $this->addFlash('danger', 'La production de jour est déjà enregistrée, vous pouvez la modifier dans la liste des productions.');

                return $this->redirect($request->headers->get('referer'));
            }

            $entityManager = $this->getDoctrine()->getManager();

            $production->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $production->setCategorie($categorieRepository->find(1));

            $entityManager->persist($production);
            $entityManager->flush();

            $this->addFlash('success', 'Enregistrement effectué avec succès');
            return $this->redirect($request->headers->get('referer'));
        }

        return $this->redirectToRoute('production_index');
    }

    /**
     * @Route("/{id}", name="production_show", methods={"GET"})
     */
    public function show(Production $production): Response
    {
        return $this->render('production/show.html.twig', [
            'production' => $production,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="production_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Production $production): Response
    {
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('production_index');
        }

        return $this->render('production/edit.html.twig', [
            'production' => $production,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="production_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Production $production): Response
    {
        if ($this->isCsrfTokenValid('delete'.$production->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($production);
            $entityManager->flush();
        }

        return $this->redirectToRoute('production_index');
    }
}
