<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\AnneeRepository;
use App\Repository\SiteWebRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/auth/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/", name="user_index", methods={"GET","POST"})
     */
    public function new(Request $request, UserRepository $userRepository, SluggerInterface $slugger, AnneeRepository $anneeRepository, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user->setIsActif(true);
            $user->setCreatedAt(new \DateTime('now'));
            $user->setCreatedBy($this->getUser());
            $user->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));

            $roles = ["ROLE_USER"];

            foreach ($request->get('roles') as $role){
                $roles [] = $role;
            }

            $user->setRoles($roles);
            $user->setPassword($passwordEncoder->encodePassword($user,'hospitalSight'));

            /**  Upload de la photo
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('user_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $user->setPhoto( 'uploads/images/user/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Utilisateur ajouté avec succès.');
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'users' => $userRepository->findBy([], ['id'=>"DESC"]),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**  Upload de la photo
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('user_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $user->setPhoto( 'uploads/images/user/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('warning', 'Utilisateur modifié avec succès.');

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/{id}/password/reset", name="user_reset_password", methods={"GET"})
     */
    public function user_reset_password(User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setPassword($passwordEncoder->encodePassword($user,'hospitalSight'));
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Mot de passe réinitialisé avec succès.');


        return $this->redirectToRoute('user_index');
    }
}
