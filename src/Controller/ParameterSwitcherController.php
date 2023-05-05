<?php

namespace App\Controller;

use App\Entity\ImageGallerie;
use App\Entity\Service;
use App\Entity\Slide;
use App\Entity\TeamMember;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\ParametresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParameterSwitcherController extends AbstractController
{

    /**
     * @Route("/enable/fb/switch/param", name="facebook_switch_param", methods={"GET", "POST"})
     */
    public function fb_switch_param(Request $request, ParametresRepository $parametresRepository): Response
    {
        $param_id = $request->get('paramId');

        $parametre = $parametresRepository->find($param_id);

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsFacebookEnable()){

            $parametre->setIsFacebookEnable(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsFacebookEnable(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


    /**
     * @Route("/enable/linkdin/switch/param", name="linkdin_switch_param", methods={"GET", "POST"})
     */
    public function linkdin_switch_param(Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsLinkdinEnabled()){

            $parametre->setIsLinkdinEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsLinkdinEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


    /**
     * @Route("/enable/twitter/switch/param", name="twitter_switch_param", methods={"GET", "POST"})
     */
    public function twitter_switch_param(Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsTwitterEnabled()){

            $parametre->setIsTwitterEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsTwitterEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


    /**
     * @Route("/enable/youtube/switch/param", name="youtube_switch_param", methods={"GET", "POST"})
     */
    public function youtube_switch_param(Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsYoutubeEnabled()){

            $parametre->setIsYoutubeEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsYoutubeEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


    /**
     * @Route("/enable/mail/admin/rdv", name="mail_admin_rdv_switch_param", methods={"GET", "POST"})
     */
    public function mail_admin_rdv_switch_param(Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getEmailToAdminAfterNewRDV()){

            $parametre->setEmailToAdminAfterNewRDV(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setEmailToAdminAfterNewRDV(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/enable/mail/visiteur/rdv", name="mail_client_rdv_switch_param", methods={"GET", "POST"})
     */
    public function mail_client_rdv_switch_param(Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getEmailToClientAfterNewRDV()){

            $parametre->setEmailToClientAfterNewRDV(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setEmailToClientAfterNewRDV(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/enable/sms/admin/rdv", name="sms_admin_rdv_switch_param", methods={"GET", "POST"})
     */
    public function sms_admin_rdv_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getSmsToAdminAfterNewRDV()){

            $parametre->setSmsToAdminAfterNewRDV(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setSmsToAdminAfterNewRDV(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/enable/sms/visiteur/rdv", name="sms_client_rdv_switch_param", methods={"GET", "POST"})
     */
    public function sms_client_rdv_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getSmsToClientAfterNewRDV()){

            $parametre->setSmsToClientAfterNewRDV(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setSmsToClientAfterNewRDV(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


    /**
     * @Route("/enable/mail/admin/mailing", name="mail_admin_mailing_switch_param", methods={"GET", "POST"})
     */
    public function mail_admin_mailing_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getEmailToAdminAfterNewMailing()){

            $parametre->setEmailToAdminAfterNewMailing(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setEmailToAdminAfterNewMailing(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/enable/mail/visiteur/mailing", name="mail_visiteur_mailing_switch_param", methods={"GET", "POST"})
     */
    public function mail_visiteur_mailing_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getEmailToClientAfterNewMailing()){

            $parametre->setEmailToClientAfterNewMailing(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setEmailToClientAfterNewMailing(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/enable/mail/admin/newsletter", name="mail_admin_newsletter_switch_param", methods={"GET", "POST"})
     */
    public function mail_admin_newsletter_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getEmailToAdminAfterNewAddNewsletter()){

            $parametre->setEmailToAdminAfterNewAddNewsletter(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setEmailToAdminAfterNewAddNewsletter(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/enable/mail/visiteur/newsletter", name="mail_visiteur_newsletter_switch_param", methods={"GET", "POST"})
     */
    public function mail_visiteur_newsletter_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getEmailToClientAfterNewAddNewsletter()){

            $parametre->setEmailToClientAfterNewAddNewsletter(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setEmailToClientAfterNewAddNewsletter(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/horaire/section", name="show_horaire_switch_param", methods={"GET", "POST"})
     */
    public function show_horaire_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsPlageOuvertureEnabled()){

            $parametre->setIsPlageOuvertureEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsPlageOuvertureEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/phone/section", name="show_phone_number_switch_param", methods={"GET", "POST"})
     */
    public function show_phone_number_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsPhoneNumberEnabled()){

            $parametre->setIsPhoneNumberEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsPhoneNumberEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/facebook/icon", name="show_facebook_icon_switch_param", methods={"GET", "POST"})
     */
    public function show_facebook_icon_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsFacebookEnable()){

            $parametre->setIsFacebookEnable(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsFacebookEnable(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/linkidin/icon", name="show_linkidin_icon_switch_param", methods={"GET", "POST"})
     */
    public function show_linkidin_icon_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsLinkdinEnabled()){

            $parametre->setIsLinkdinEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsLinkdinEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/twitter/icon", name="show_twitter_icon_switch_param", methods={"GET", "POST"})
     */
    public function show_twitter_icon_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsTwitterEnabled()){

            $parametre->setIsTwitterEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsTwitterEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/youtube/icon", name="show_youtube_icon_switch_param", methods={"GET", "POST"})
     */
    public function show_youtube_icon_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsYoutubeEnabled()){

            $parametre->setIsyoutubeEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsYoutubeEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/disponibilite/section", name="show_disponibilite_section_switch_param", methods={"GET", "POST"})
     */
    public function show_disponibilite_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionDisponibiliteEnabled()){

            $parametre->setIsSectionDisponibiliteEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionDisponibiliteEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/service/section", name="show_service_section_switch_param", methods={"GET", "POST"})
     */
    public function show_service_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionServiceEnabled()){

            $parametre->setIsSectionServiceEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionServiceEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/urgence/section", name="show_urgence_section_switch_param", methods={"GET", "POST"})
     */
    public function show_urgence_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionEmergencyEnabled()){

            $parametre->setIsSectionEmergencyEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionEmergencyEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/apropos/section", name="show_apropos_section_switch_param", methods={"GET", "POST"})
     */
    public function show_apropos_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionAboutEnabled()){

            $parametre->setIsSectionAboutEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionAboutEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/stats/section", name="show_stat_section_switch_param", methods={"GET", "POST"})
     */
    public function show_stats_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionChiffreEnabled()){

            $parametre->setIsSectionChiffreEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionChiffreEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/salle/section", name="show_salle_section_switch_param", methods={"GET", "POST"})
     */
    public function show_salle_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionCol66Enabled()){

            $parametre->setIsSectionCol66Enabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionCol66Enabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/rendevous/form", name="show_rendevous_section_switch_param", methods={"GET", "POST"})
     */
    public function show_rendevous_form_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsFormRDVenabled()){

            $parametre->setIsFormRDVenabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsFormRDVenabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/produit/section", name="show_produit_section_switch_param", methods={"GET", "POST"})
     */
    public function show_produit_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectioncol4ProduitEnabled()){

            $parametre->setIsSectioncol4ProduitEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectioncol4ProduitEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/actualite/section", name="show_actualite_section_switch_param", methods={"GET", "POST"})
     */
    public function show_actualite_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionActualiteEnabled()){

            $parametre->setIsSectionActualiteEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionActualiteEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/temoignage/section", name="show_temoignage_section_switch_param", methods={"GET", "POST"})
     */
    public function show_temoignage_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionTestimonialEnabled()){

            $parametre->setIsSectionTestimonialEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionTestimonialEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/medecin/section", name="show_medecin_section_switch_param", methods={"GET", "POST"})
     */
    public function show_medecin_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionTeamEnabled()){

            $parametre->setIsSectionTeamEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionTeamEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/outil/section", name="show_outil_section_switch_param", methods={"GET", "POST"})
     */
    public function show_outil_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionSlideOutilsEnabled()){

            $parametre->setIsSectionSlideOutilsEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionSlideOutilsEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/prix/section", name="show_prix_section_switch_param", methods={"GET", "POST"})
     */
    public function show_prix_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionPricingEnabled()){

            $parametre->setIsSectionPricingEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionPricingEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/FAQ/section", name="show_FAQ_section_switch_param", methods={"GET", "POST"})
     */
    public function show_FAQ_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionFAQenabled()){

            $parametre->setIsSectionFAQenabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionFAQenabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/maps/section", name="show_maps_section_switch_param", methods={"GET", "POST"})
     */
    public function show_maps_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionMapsEnabled()){

            $parametre->setIsSectionMapsEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionMapsEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/form_email/section", name="show_form_email_section_switch_param", methods={"GET", "POST"})
     */
    public function show_form_email_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionQuickEmailEnabled()){

            $parametre->setIsSectionQuickEmailEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionQuickEmailEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/show/form_newsletter/section", name="show_form_newsletter_section_switch_param", methods={"GET", "POST"})
     */
    public function show_form_newsletter_section_switch_param (Request $request, ParametresRepository $parametresRepository): Response
    {

        $parametre = $parametresRepository->find($request->get('paramId'));

        if (!is_object($parametre))
            return $this->json(['error'=>'Objet paramètre non trouvé.']);


        if ($parametre->getIsSectionNewsLetterEnabled()){

            $parametre->setIsSectionNewsLetterEnabled(false);
            $message = 'Option désactivée avec succès!';
        }
        else{
            $parametre->setIsSectionNewsLetterEnabled(true);
            $message = 'Option activée avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($parametre);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/switch/article/status", name="article_switch_status", methods={"GET", "POST"})
     */
    public function article_switch_status (Request $request, ArticleRepository $articleRepository): Response
    {

        $article = $articleRepository->find($request->get('articleId'));

        if (!is_object($article))
            return $this->json(['error'=>'Objet article non trouvé.']);


        if ($article->getIsActif()){

            $article->setIsActif(false);
            $message = 'Statut désactivé avec succès!';
        }
        else{
            $article->setIsActif(true);
            $message = 'Statut activé avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($article);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/image/gallerie-{id}/switch/status", name="image_gallerie_switch_statut", methods={"GET", "POST"})
     */
    public function image_gallerie_switch_status (ImageGallerie $imageGallerie): Response
    {
        if ($imageGallerie->getIsActif()){

            $imageGallerie->setIsActif(false);
            $message = 'Statut désactivé avec succès!';
        }
        else{
            $imageGallerie->setIsActif(true);
            $message = 'Statut activé avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($imageGallerie);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/service-{id}/switch/status", name="switch_service_statut", methods={"GET", "POST"})
     */
    public function switch_service_statut (Service $service): Response
    {
        if ($service->getIsActif()){

            $service->setIsActif(false);
            $message = 'Statut désactivé avec succès!';
        }
        else{
            $service->setIsActif(true);
            $message = 'Statut activé avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($service);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


    /**
     * @Route("/slide-{id}/switch/status", name="slide_switch_status", methods={"GET", "POST"})
     */
    public function slide_switch_status (Slide $slide): Response
    {
        if ($slide->getIsActif()){

            $slide->setIsActif(false);
            $message = 'Statut désactivé avec succès!';
        }
        else{
            $slide->setIsActif(true);
            $message = 'Statut activé avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($slide);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }

    /**
     * @Route("/team-member-{id}/switch/status", name="team_member_switch_status", methods={"GET", "POST"})
     */
    public function team_member_switch_status (TeamMember $teamMember): Response
    {
        if ($teamMember->getIsActif()){

            $teamMember->setIsActif(false);
            $message = 'Statut désactivé avec succès!';
        }
        else{
            $teamMember->setIsActif(true);
            $message = 'Statut activé avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($teamMember);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


    /**
     * @Route("/user-{id}/switch/status", name="user_switch_status", methods={"GET", "POST"})
     */
    public function user_switch_status (User $user): Response
    {
        if ($user->getIsActif()){

            $user->setIsActif(false);
            $message = 'Statut désactivé avec succès!';
        }
        else{
            $user->setIsActif(true);
            $message = 'Statut activé avec succès!';
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();

        return $this->json([
            'code'=> 200,
            'statut'=>"Ok",
            'message'=> $message,
        ], 200);
    }


}
