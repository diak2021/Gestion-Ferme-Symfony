<?php

namespace App\Security;

use App\Entity\Annee;
use App\Entity\User;
use App\Repository\AnneeRepository;
use App\Service\Helper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class UserAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private $entityManager;
    private $session;
    private $urlGenerator;
    private $csrfTokenManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session,UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    public function supports(Request $request)
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);

        if (!$user) {
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function getPassword($credentials): ?string
    {
        return $credentials['password'];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        $anneeEnCours = $this->entityManager->getRepository(Annee::class)->findOneBy(['isEnCours'=>true], ['createdAt'=>'DESC']);

        if(!is_object($anneeEnCours))
            $anneeEnCours = $this->entityManager->getRepository(Annee::class)->findOneBy(['annee'=>date('Y')], ['createdAt'=>'DESC']);

        if(!is_object($anneeEnCours)){
            $anneeEnCours = $this->creationAnneeEncours();
        }
        else{
            $this->disableOldYears();
            $anneeEnCours->setIsEnCours(true);
            $this->entityManager->persist($anneeEnCours);
            $this->entityManager->flush();
        }
        if($anneeEnCours->getAnnee() != date('Y')){
            $anneeEnCours = $this->creationAnneeEncours();
        }

        /** Mettre l'année en session */
        $this->session->set('anneeEnCours', $anneeEnCours);

        $this->session->set('newConnexion', true);

        return new RedirectResponse($this->urlGenerator->generate('dashboard'));
//        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function creationAnneeEncours(){

        /** les autres années ne seront plus en cours */
        $this->disableOldYears();

        /** créer la nouvelle année */
        $anneeEnCours = new Annee();
        $anneeEnCours->setCreatedAt(new \DateTime());
        $anneeEnCours->setAnnee(date('Y'));
        $anneeEnCours->setDetail('Création Automatique');
        $anneeEnCours->setCode(date('Y'));
        $anneeEnCours->setIsEnCours(true);

        $this->entityManager->persist($anneeEnCours);
        $this->entityManager->flush();

        return $anneeEnCours;
    }

    protected function disableOldYears(){
        $annees =  $this->entityManager->getRepository(Annee::class)->findBy(['isEnCours'=>true]);
        foreach ($annees as $annee){
            $annee->setIsEnCours(false);
            $this->entityManager->persist($annee);
        }
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
