<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\AnneeRepository;
use App\Repository\ArticleRepository;
use App\Repository\SiteWebRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/auth/article")
 */
class ArticleController extends AbstractController
{

    /**
     * @Route("/", name="article_index", methods={"GET","POST"})
     */
    public function new(Request $request, ArticleRepository $articleRepository, AnneeRepository $anneeRepository, SiteWebRepository $siteWebRepository, SluggerInterface $slugger): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $article->setIsActif(true);
            $article->setCreatedAt(new \DateTime('now'));
            $article->setSiteWeb($siteWebRepository->find(1));
            $article->getCreatedBy($this->getUser());
            $article->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));

            if ($article->getIsPrincipal()){
                $article_old_principal = $articleRepository->findOneBy(['isPrincipal'=>1]);
                if ($article_old_principal){
                    $article_old_principal->setIsPrincipal(false);
                    $entityManager->persist($article_old_principal);
                }
            }else{
                $article->setIsPrincipal(false);
            }

            /**  Fin Upload de la photo
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('article_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $article->setPhoto( 'uploads/images/article/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */
            $this->addFlash('success', '✔ Nouvel article ajouté avec succès.');

            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/index.html.twig', [
            'article' => $article,
            'articles' => $articleRepository->findBy([], ['isActif'=>"DESC", 'id'=>"DESC", ]),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article, ArticleRepository $articleRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            if ($article->getIsPrincipal()){
                $article_old_principal = $articleRepository->findOneBy(['isPrincipal'=>true]);
                if ($article_old_principal){
                    $article_old_principal->setIsPrincipal(false);
                    $entityManager->persist($article_old_principal);
                }
            }else{
                $article->setIsPrincipal(false);
            }

            /** Upload de la photo
             */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                try {
                    $photo->move(
                        $this->getParameter('article_image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de l\'envoie de l\'image');
                }
                // mise à jour du nom du fichier en rajoutant le chemin complet pour faciliter l'écriture du lien dans asset{{}}
                $article->setPhoto( 'uploads/images/article/'.$newFilename);
            }
            /**  Fin Upload de la photo
             */

            $this->addFlash('success', '✔ Mise à jour effectuée avec succès.');
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('article_index');
    }
}
