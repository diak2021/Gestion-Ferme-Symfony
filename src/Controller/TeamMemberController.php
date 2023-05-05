<?php

namespace App\Controller;

use App\Entity\TeamMember;
use App\Form\TeamMemberType;
use App\Repository\AnneeRepository;
use App\Repository\SiteWebRepository;
use App\Repository\TeamMemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Iterator\DateRangeFilterIterator;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/auth/team/member")
 */
class TeamMemberController extends AbstractController
{

    /**
     * @Route("/", name="team_member_index", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger, TeamMemberRepository $teamMemberRepository, AnneeRepository $anneeRepository, SiteWebRepository $siteWebRepository): Response
    {
        $teamMember = new TeamMember();
        $form = $this->createForm(TeamMemberType::class, $teamMember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $teamMember->setIsActif(true);
            $teamMember->setSiteWeb($siteWebRepository->find(1));
            $teamMember->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $teamMember->setCreatedAt(new \DateTime('now'));

            /**  Fin Upload de la photo
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('team_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $teamMember->setPhoto( 'uploads/images/team/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $entityManager->persist($teamMember);
            $entityManager->flush();

            $this->addFlash('success', '✔ Enregistrement effectué avec succès !');
            return $this->redirectToRoute('team_member_index');
        }

        return $this->render('team_member/index.html.twig', [
            'team_member' => $teamMember,
            'form' => $form->createView(),
            'team_members' => $teamMemberRepository->findBy([], ['id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/{id}", name="team_member_show", methods={"GET"})
     */
    public function show(TeamMember $teamMember): Response
    {
        return $this->render('team_member/show.html.twig', [
            'team_member' => $teamMember,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="team_member_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TeamMember $teamMember, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(TeamMemberType::class, $teamMember);
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
                        $this->getParameter('team_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $teamMember->setPhoto( 'uploads/images/team/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $manager->persist($teamMember);
            $manager->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('team_member_index');
        }

        return $this->render('team_member/edit.html.twig', [
            'team_member' => $teamMember,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_member_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TeamMember $teamMember): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teamMember->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($teamMember);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('team_member_index');
    }
}
