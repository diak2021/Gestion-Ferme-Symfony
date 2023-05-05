<?php

namespace App\Controller;

use App\Entity\Slide;
use App\Form\SlideType;
use App\Repository\AnneeRepository;
use App\Repository\SiteWebRepository;
use App\Repository\SlideRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Twig\Node\Expression\Test\DefinedTest;

/**
 * @Route("/auth/slide")
 */
class SlideController extends AbstractController
{

    /**
     * @Route("/", name="slide_index", methods={"GET","POST"})
     */
    public function new(Request $request,SlideRepository $slideRepository, SluggerInterface $slugger, SiteWebRepository $siteWebRepository, AnneeRepository $anneeRepository): Response
    {
        $slide = new Slide();
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);

        $slide->setSiteWeb($siteWebRepository->find(1));
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $slide->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $slide->setSiteWeb($siteWebRepository->find(1));
            $slide->setCreatedBy($this->getUser());
            $slide->setCreatedAt(new \DateTime('now'));
            $slide->setIsActif(true);

            /**
             * Upload de la photo debut
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('slide_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $slide->setPhoto( 'uploads/images/slide/'.$newFilename);
            }
            /**
             * Fin upload de la photo debut
             */

            $entityManager->persist($slide);
            $entityManager->flush();

            $this->addFlash('success', '✔ Enregistrement effectué avec succès !');
            return $this->redirectToRoute('slide_index');
        }

        return $this->render('slide/index.html.twig', [
            'slide' => $slide,
            'form' => $form->createView(),
            'slides' => $slideRepository->findBy([], ['id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/{id}", name="slide_show", methods={"GET"})
     */
    public function show(Slide $slide): Response
    {
        return $this->render('slide/show.html.twig', [
            'slide' => $slide,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="slide_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Slide $slide, SluggerInterface $slugger, SiteWebRepository $siteWebRepository): Response
    {
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);

        $slide->setSiteWeb($siteWebRepository->find(1));
        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * Upload de la photo debut
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('slide_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $slide->setPhoto( 'uploads/images/slide/'.$newFilename);
            }
            /**
             * Fin upload de la photo debut
             */

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($slide);
            $manager->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('slide_index');
        }

        return $this->render('slide/edit.html.twig', [
            'slide' => $slide,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="slide_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Slide $slide): Response
    {
        if ($this->isCsrfTokenValid('delete'.$slide->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($slide);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('slide_index');
    }
}
