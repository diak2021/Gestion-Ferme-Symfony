<?php

namespace App\Controller;

use App\Entity\ImageGallerie;
use App\Form\ImageGallerieType;
use App\Repository\AnneeRepository;
use App\Repository\ImageGallerieRepository;
use App\Repository\SiteWebRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/image/gallerie")
 */
class ImageGallerieController extends AbstractController
{

    /**
     * @Route("/new", name="image_gallerie_index", methods={"GET","POST"})
     */
    public function new(Request $request, ImageGallerieRepository $imageGallerieRepository, SluggerInterface $slugger, SiteWebRepository $siteWebRepository): Response
    {
        $imageGallerie = new ImageGallerie();
        $form = $this->createForm(ImageGallerieType::class, $imageGallerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $imageGallerie->setCreatedBy($this->getUser());
            $imageGallerie->setCreatedAt(new \DateTime('now'));
            $imageGallerie->setSiteWeb($siteWebRepository->find(1));
            $imageGallerie->setIsActif(true);

            /**  Fin Upload de la photo
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('gallerie_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $imageGallerie->setPhoto( 'uploads/images/gallerie/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $entityManager->persist($imageGallerie);
            $entityManager->flush();

            $this->addFlash('success', '✔ Enregistrement effectué avec succès !');
            return $this->redirectToRoute('image_gallerie_index');
        }

        return $this->render('image_gallerie/index.html.twig', [
            'image_gallerie' => $imageGallerie,
            'form' => $form->createView(),
            'image_galleries' => $imageGallerieRepository->findBy([], ['isActif'=>"DESC", 'id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/{id}", name="image_gallerie_show", methods={"GET"})
     */
    public function show(ImageGallerie $imageGallerie): Response
    {
        return $this->render('image_gallerie/show.html.twig', [
            'image_gallerie' => $imageGallerie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="image_gallerie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ImageGallerie $imageGallerie, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ImageGallerieType::class, $imageGallerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            /**  Fin Upload de la photo
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('gallerie_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $imageGallerie->setPhoto( 'uploads/images/gallerie/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $manager->persist($imageGallerie);
            $manager->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('image_gallerie_index');
        }

        return $this->render('image_gallerie/edit.html.twig', [
            'image_gallerie' => $imageGallerie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_gallerie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ImageGallerie $imageGallerie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imageGallerie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($imageGallerie);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('image_gallerie_index');
    }
}
