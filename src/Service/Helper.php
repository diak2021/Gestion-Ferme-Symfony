<?php

namespace App\Service;

use App\Entity\Annee;
use App\Entity\Email;
use App\Entity\Parametres;
use App\Entity\RendezVous;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Helper extends AbstractController{

    protected $session = null;
    protected $request = null;
    protected $manager;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function anneeEnCours (){
        return $this->getDoctrine()->getManager()->getRepository(Annee::class)->find($this->session->get('anneeEnCours'));
    }

    public function refreshInfosSession(){

        $new_emails = $this->getDoctrine()->getManager()->getRepository(Email::class)->findBy(['siteWeb'=>1, 'isMailEntrant'=>true, 'isLu'=>false]);
        $new_rdv = $this->getDoctrine()->getManager()->getRepository(RendezVous::class)->findBy(['siteWeb'=>1, 'isActif'=>true, 'isLu'=>false]);
        $parametre = $this->getDoctrine()->getManager()->getRepository(Parametres::class)->findOneBy(['siteWeb'=>1]);

        $this->session->set('newEmails', $new_emails);
        $this->session->set('newRdv', $new_rdv);
        $this->session->set('parametre', $parametre);
    }

    public function sendSms($phoneNumber, $message)
    {
        $config = [
            'clientId' => $this->getParameter('sms_client_id'),
            'clientSecret' =>  $this->getParameter('sms_client_secret'),
        ];

        $osms = new \App\Service\Osms($config);

        $data = $osms->getTokenFromConsumerKey();
//        $token = array(
//            'token' => $data['access_token']
//        );

        return $osms->sendSms(

            'tel:+224621623235',
            $phoneNumber,
            $message,
            1
        );
    }

    public function getSmsRestant()
    {

        $config = [
            'clientId' => $this->getParameter('sms_client_id'),
            'clientSecret' =>  $this->getParameter('sms_client_secret'),
        ];

        $osms = new Osms($config);
        $osms->setVerifyPeerSSL(false);

        //$response = $osms->getAdminStats(array('country' => 'CIV'));
        // $response = $osms->getAdminStats();
        // $response = $osms->getAdminStats(array('appid' => 'your_app_id'));

//        $response = $osms->getAdminStats();
        $response = $osms->getTokenFromConsumerKey();
        $token = $response['access_token'];

        $config2 = [
            'clientId' => $this->getParameter('sms_client_id'),
            'clientSecret' =>  $this->getParameter('sms_client_secret'),
            'token'=>$token
        ];
        $osms = new Osms($config2);
        $response = $osms->getAdminStats(array('country' => 'GIN', 'appid' => '04r4ANF1genvkJuB'));

        return $response;

    }


    /** CETTE FONCTION PREPARE LE NUMERO DU RECEVEUR */
    public function prepareNumber($tel)
    {
        $tel = str_replace(' ', '', $tel);
        $tel = str_replace('-', '', $tel);
        $tel = str_replace('(', '', $tel);
        $tel = str_replace(')', '', $tel);
        $tel = str_replace('+', '', $tel);

        if (preg_match('#^224[0-9]{9}$#', $tel)) {
            $receiverAdress = 'tel:+' . $tel;

        } elseif (preg_match('#^6[0-9]{8}$#', $tel)) {
            $receiverAdress = 'tel:+224' . $tel;

        } else {
            return false;
        }

        return $receiverAdress;
    }

}