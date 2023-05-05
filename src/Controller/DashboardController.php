<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\ProductionType;
use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\EmailRepository;
use App\Repository\FeedbackRepository;
use App\Repository\ImageGallerieRepository;
use App\Repository\NewsletterRepository;
use App\Repository\ParametresRepository;
use App\Repository\ProductionRepository;
use App\Repository\QuestionRepository;
use App\Repository\RendezVousRepository;
use App\Repository\ServiceRepository;
use App\Repository\SlideRepository;
use App\Repository\TeamMemberRepository;
use App\Service\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ParametresRepository $parametresRepository, SlideRepository $slideRepository): Response
    {
        $parametre = $parametresRepository->findOneBy(['siteWeb'=>1]);

        return $this->render('frontend/index.html.twig', [
            'parametre'=>$parametre,
            'slides'=>$slideRepository->findBy(['siteWeb'=>1, 'isActif'=>true]),
        ]);
    }

    /**
     * @Route("/auth/dashboard", name="dashboard")
     */
    public function dashboard(ProductionRepository $productionRepository, CategorieRepository $categorieRepository): Response
    {
        $production = new Production();
        $form = $this->createForm(ProductionType::class, $production);

        $date = \date('Y-m-d');

        $custom_date = strtotime( date('Y-m-d', strtotime($date)) );

        $week_start = date('Y-m-d', strtotime('this week last monday', $custom_date));
        $week_end = date('Y-m-d', strtotime('this week next sunday', $custom_date));

        $month_start = date('Y-m-d', strtotime('first day of this month', $custom_date));
        $month_end = date('Y-m-d', strtotime('last day of this month', $custom_date));

        $stats_alveole_du_jour = $productionRepository->statsAlveoleParSeance('journaliere', $date);
        $stats_alveole_semaine = $productionRepository->statsAlveoleParSeance('hebdomadaire', false, $week_start, $week_end);
        $stats_alveole_du_mois = $productionRepository->statsAlveoleParSeance('mensuelle', false, false,false, $month_start, $month_end);
        $stats_alveoles_totales_cumulees = $productionRepository->statsAlveoleParSeance();
        
        $prixOeufDefault = $categorieRepository->find(1)->getPrixUnitaireParDefaut();

        return $this->render('dashboard/index.html.twig', [
           'form'=>$form->createView(),
            'prixOeufDefaut'=> $prixOeufDefault,
            'stats_alveole_du_jour'=>$stats_alveole_du_jour[0],
            'stats_alveole_semaine'=>$stats_alveole_semaine[0],
            'stats_alveole_du_mois'=>$stats_alveole_du_mois[0],
            'stats_alveole_cumul_total'=>$stats_alveoles_totales_cumulees[0],
        ]);
    }
}
