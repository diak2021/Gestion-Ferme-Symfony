<?php

namespace App\Controller;

use App\Entity\Parametres;
use App\Form\ParametresType;
use App\Repository\ParametresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/auth/parametres")
 */
class ParametresController extends AbstractController
{
    /**
     * @Route("/", name="parametres_index", methods={"GET"})
     */
    public function index(ParametresRepository $parametresRepository): Response
    {
        return $this->render('parametres/index.html.twig', [
            'parametre' => $parametresRepository->findOneBy(['siteWeb'=>1]),
        ]);
    }

    /**
     * @Route("/new", name="parametres_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $parametre = new Parametres();
        $form = $this->createForm(ParametresType::class, $parametre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            /**
             * Upload de la photo debut
             */
            $logo = $form->get('logo')->getData();
            if ($logo) {
                $originalFilename = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logo->guessExtension();

                try {
                    $logo->move(
                        $this->getParameter('logo_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $parametre->setLogo( 'uploads/images/logo/'.$newFilename);
            }

            $photo = $form->get('favicon')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('logo_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $parametre->setFavicon( 'uploads/images/logo/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $entityManager->persist($parametre);
            $entityManager->flush();

            $this->addFlash('success', '✔ Enregistrement effectué avec succès !');
            return $this->redirectToRoute('parametres_index');
        }

        return $this->render('parametres/new.html.twig', [
            'parametre' => $parametre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parametres_show", methods={"GET"})
     */
    public function show(Parametres $parametre): Response
    {
        return $this->render('parametres/show.html.twig', [
            'parametre' => $parametre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parametres_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parametres $parametre, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ParametresType::class, $parametre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * Upload de la photo debut
             */
            $photo = $form->get('logo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('logo_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $parametre->setLogo( 'uploads/images/logo/'.$newFilename);
            }

            $photo = $form->get('favicon')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('logo_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $parametre->setFavicon( 'uploads/images/logo/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($parametre);
            $manager->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');

            return $this->redirectToRoute('parametres_index');
        }

        return $this->render('parametres/edit.html.twig', [
            'parametre' => $parametre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parametres_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Parametres $parametre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parametre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parametre);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('parametres_index');
    }

}
