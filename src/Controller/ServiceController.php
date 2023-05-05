<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\AnneeRepository;
use App\Repository\ServiceRepository;
use App\Repository\SiteWebRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auth/service")
 */
class ServiceController extends AbstractController
{

    /**
     * @Route("/", name="service_index", methods={"GET","POST"})
     */
    public function new(Request $request, ServiceRepository $serviceRepository, AnneeRepository $anneeRepository, SiteWebRepository $siteWebRepository): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $service->setIsActif(true);
            $service->setSiteWeb($siteWebRepository->find(1));
            $service->setAnnee($anneeRepository->findOneBy(['isEnCours'=>true]));
            $service->setCreatedAt(new \DateTime('now'));
            $service->setCreatedBy($this->getUser());

            $entityManager->persist($service);
            $entityManager->flush();

            $this->addFlash('success', '✔ Enregistrement effectué avec succès !');
            return $this->redirectToRoute('service_index');
        }

        return $this->render('service/index.html.twig', [
            'service' => $service,
            'services' => $serviceRepository->findBy([], ['id'=>"DESC"]),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_show", methods={"GET"})
     */
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Service $service): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', '✔ Mise à jour éffectuée avec succès !');
            return $this->redirectToRoute('service_index');
        }

        return $this->render('service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Service $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
            $this->addFlash('danger', '✔ Suppression effectuée avec succès !');
        }

        return $this->redirectToRoute('service_index');
    }
}
