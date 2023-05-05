<?php

namespace App\Controller;

use App\Entity\Annee;
use App\Form\AnneeType;
use App\Repository\AnneeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth/annee")
 */
class AnneeController extends AbstractController
{

    /**
     * @Route("/new", name="annee_index", methods={"GET","POST"})
     */
    public function new(Request $request, AnneeRepository $anneeRepository): Response
    {
        $annee = new Annee();
        $form = $this->createForm(AnneeType::class, $annee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $annee->setCreatedAt(new \DateTime('now'));
            if ($annee->getIsEnCours()){
                $annees_old_en_cours = $anneeRepository->findBy(['isEnCours'=>true]);
                foreach ($annees_old_en_cours as $an){
                    $an->setIsEnCours(false);
                    $entityManager->persist($an);
                }
            }

            $entityManager->persist($annee);
            $entityManager->flush();

            $this->addFlash('success', '✔ Nouvelle année ajoutée avec succès !');
            return $this->redirectToRoute('annee_index');
        }

        return $this->render('annee/index.html.twig', [
            'annee' => $annee,
            'annees' => $anneeRepository->findBy([], ['id'=>"DESC"]),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annee_show", methods={"GET"})
     */
    public function show(Annee $annee): Response
    {
        return $this->render('annee/show.html.twig', [
            'annee' => $annee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="annee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Annee $annee, AnneeRepository $anneeRepository): Response
    {
        $form = $this->createForm(AnneeType::class, $annee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            if ($annee->getIsEnCours()){
                $annees_old_en_cours = $anneeRepository->findBy(['isEnCours'=>true]);
                foreach ($annees_old_en_cours as $an){
                    $an->setIsEnCours(false);
                    $entityManager->persist($an);
                }
            }
            $entityManager->persist($annee);
            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('annee_index');
        }

        return $this->render('annee/edit.html.twig', [
            'annee' => $annee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annee_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Annee $annee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annee);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('annee_index');
    }
}
