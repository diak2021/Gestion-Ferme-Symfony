<?php

namespace App\Entity;

use App\Repository\ParametresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParametresRepository::class)
 */
class Parametres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelleStructure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkdin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youtube;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionServiceEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionEmergencyEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionAboutEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionChiffreEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionCol6_6Enabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectioncol4ProduitEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFormRDVenabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionActualiteEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionTestimonialEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionTeamEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionSlideOutilsEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionPricingEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionFAQenabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionMapsEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionQuickEmailEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFacebookEnable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isTwitterEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLinkdinEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isYoutubeEnabled;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $couleurPrincipale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plageOuvertureDesLocaux;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $favicon;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionNewsLetterEnabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slogan;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPlageOuvertureEnabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPhoneNumberEnabled;

    /**
     * @ORM\OneToOne(targetEntity=SiteWeb::class, cascade={"persist", "remove"})
     */
    private $siteWeb;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSectionDisponibiliteEnabled;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreArticlesPublier;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailToAdminAfterNewRDV;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailToClientAfterNewRDV;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $smsToClientAfterNewRDV;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $smsToAdminAfterNewRDV;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailToClientAfterNewMailing;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailToAdminAfterNewMailing;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailToAdminAfterNewAddNewsletter;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emailToClientAfterNewAddNewsletter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLibelleStructure(): ?string
    {
        return $this->libelleStructure;
    }

    public function setLibelleStructure(?string $libelleStructure): self
    {
        $this->libelleStructure = $libelleStructure;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getLinkdin(): ?string
    {
        return $this->linkdin;
    }

    public function setLinkdin(?string $linkdin): self
    {
        $this->linkdin = $linkdin;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getIsSectionServiceEnabled(): ?bool
    {
        return $this->isSectionServiceEnabled;
    }

    public function setIsSectionServiceEnabled(?bool $isSectionServiceEnabled): self
    {
        $this->isSectionServiceEnabled = $isSectionServiceEnabled;

        return $this;
    }

    public function getIsSectionEmergencyEnabled(): ?bool
    {
        return $this->isSectionEmergencyEnabled;
    }

    public function setIsSectionEmergencyEnabled(?bool $isSectionEmergencyEnabled): self
    {
        $this->isSectionEmergencyEnabled = $isSectionEmergencyEnabled;

        return $this;
    }

    public function getIsSectionAboutEnabled(): ?bool
    {
        return $this->isSectionAboutEnabled;
    }

    public function setIsSectionAboutEnabled(?bool $isSectionAboutEnabled): self
    {
        $this->isSectionAboutEnabled = $isSectionAboutEnabled;

        return $this;
    }

    public function getIsSectionChiffreEnabled(): ?bool
    {
        return $this->isSectionChiffreEnabled;
    }

    public function setIsSectionChiffreEnabled(?bool $isSectionChiffreEnabled): self
    {
        $this->isSectionChiffreEnabled = $isSectionChiffreEnabled;

        return $this;
    }

    public function getIsSectionCol66Enabled(): ?bool
    {
        return $this->isSectionCol6_6Enabled;
    }

    public function setIsSectionCol66Enabled(?bool $isSectionCol6_6Enabled): self
    {
        $this->isSectionCol6_6Enabled = $isSectionCol6_6Enabled;

        return $this;
    }

    public function getIsSectioncol4ProduitEnabled(): ?bool
    {
        return $this->isSectioncol4ProduitEnabled;
    }

    public function setIsSectioncol4ProduitEnabled(?bool $isSectioncol4ProduitEnabled): self
    {
        $this->isSectioncol4ProduitEnabled = $isSectioncol4ProduitEnabled;

        return $this;
    }

    public function getIsFormRDVenabled(): ?bool
    {
        return $this->isFormRDVenabled;
    }

    public function setIsFormRDVenabled(?bool $isFormRDVenabled): self
    {
        $this->isFormRDVenabled = $isFormRDVenabled;

        return $this;
    }

    public function getIsSectionActualiteEnabled(): ?bool
    {
        return $this->isSectionActualiteEnabled;
    }

    public function setIsSectionActualiteEnabled(?bool $isSectionActualiteEnabled): self
    {
        $this->isSectionActualiteEnabled = $isSectionActualiteEnabled;

        return $this;
    }

    public function getIsSectionTestimonialEnabled(): ?bool
    {
        return $this->isSectionTestimonialEnabled;
    }

    public function setIsSectionTestimonialEnabled(?bool $isSectionTestimonialEnabled): self
    {
        $this->isSectionTestimonialEnabled = $isSectionTestimonialEnabled;

        return $this;
    }

    public function getIsSectionTeamEnabled(): ?bool
    {
        return $this->isSectionTeamEnabled;
    }

    public function setIsSectionTeamEnabled(?bool $isSectionTeamEnabled): self
    {
        $this->isSectionTeamEnabled = $isSectionTeamEnabled;

        return $this;
    }

    public function getIsSectionSlideOutilsEnabled(): ?bool
    {
        return $this->isSectionSlideOutilsEnabled;
    }

    public function setIsSectionSlideOutilsEnabled(?bool $isSectionSlideOutilsEnabled): self
    {
        $this->isSectionSlideOutilsEnabled = $isSectionSlideOutilsEnabled;

        return $this;
    }

    public function getIsSectionPricingEnabled(): ?bool
    {
        return $this->isSectionPricingEnabled;
    }

    public function setIsSectionPricingEnabled(?bool $isSectionPricingEnabled): self
    {
        $this->isSectionPricingEnabled = $isSectionPricingEnabled;

        return $this;
    }

    public function getIsSectionFAQenabled(): ?bool
    {
        return $this->isSectionFAQenabled;
    }

    public function setIsSectionFAQenabled(?bool $isSectionFAQenabled): self
    {
        $this->isSectionFAQenabled = $isSectionFAQenabled;

        return $this;
    }

    public function getIsSectionMapsEnabled(): ?bool
    {
        return $this->isSectionMapsEnabled;
    }

    public function setIsSectionMapsEnabled(?bool $isSectionMapsEnabled): self
    {
        $this->isSectionMapsEnabled = $isSectionMapsEnabled;

        return $this;
    }

    public function getIsSectionQuickEmailEnabled(): ?bool
    {
        return $this->isSectionQuickEmailEnabled;
    }

    public function setIsSectionQuickEmailEnabled(?bool $isSectionQuickEmailEnabled): self
    {
        $this->isSectionQuickEmailEnabled = $isSectionQuickEmailEnabled;

        return $this;
    }

    public function getIsFacebookEnable(): ?bool
    {
        return $this->isFacebookEnable;
    }

    public function setIsFacebookEnable(?bool $isFacebookEnable): self
    {
        $this->isFacebookEnable = $isFacebookEnable;

        return $this;
    }

    public function getIsTwitterEnabled(): ?bool
    {
        return $this->isTwitterEnabled;
    }

    public function setIsTwitterEnabled(?bool $isTwitterEnabled): self
    {
        $this->isTwitterEnabled = $isTwitterEnabled;

        return $this;
    }

    public function getIsLinkdinEnabled(): ?bool
    {
        return $this->isLinkdinEnabled;
    }

    public function setIsLinkdinEnabled(?bool $isLinkdinEnabled): self
    {
        $this->isLinkdinEnabled = $isLinkdinEnabled;

        return $this;
    }

    public function getIsYoutubeEnabled(): ?bool
    {
        return $this->isYoutubeEnabled;
    }

    public function setIsYoutubeEnabled(?bool $isYoutubeEnabled): self
    {
        $this->isYoutubeEnabled = $isYoutubeEnabled;

        return $this;
    }

    public function getCouleurPrincipale(): ?string
    {
        return $this->couleurPrincipale;
    }

    public function setCouleurPrincipale(?string $couleurPrincipale): self
    {
        $this->couleurPrincipale = $couleurPrincipale;

        return $this;
    }

    public function getPlageOuvertureDesLocaux(): ?string
    {
        return $this->plageOuvertureDesLocaux;
    }

    public function setPlageOuvertureDesLocaux(?string $plageOuvertureDesLocaux): self
    {
        $this->plageOuvertureDesLocaux = $plageOuvertureDesLocaux;

        return $this;
    }

    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    public function setFavicon(?string $favicon): self
    {
        $this->favicon = $favicon;

        return $this;
    }

    public function getIsSectionNewsLetterEnabled(): ?bool
    {
        return $this->isSectionNewsLetterEnabled;
    }

    public function setIsSectionNewsLetterEnabled(?bool $isSectionNewsLetterEnabled): self
    {
        $this->isSectionNewsLetterEnabled = $isSectionNewsLetterEnabled;

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(?string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getIsPlageOuvertureEnabled(): ?bool
    {
        return $this->isPlageOuvertureEnabled;
    }

    public function setIsPlageOuvertureEnabled(?bool $isPlageOuvertureEnabled): self
    {
        $this->isPlageOuvertureEnabled = $isPlageOuvertureEnabled;

        return $this;
    }

    public function getIsPhoneNumberEnabled(): ?bool
    {
        return $this->isPhoneNumberEnabled;
    }

    public function setIsPhoneNumberEnabled(?bool $isPhoneNumberEnabled): self
    {
        $this->isPhoneNumberEnabled = $isPhoneNumberEnabled;

        return $this;
    }

    public function getSiteWeb(): ?SiteWeb
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(?SiteWeb $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    public function getIsSectionDisponibiliteEnabled(): ?bool
    {
        return $this->isSectionDisponibiliteEnabled;
    }

    public function setIsSectionDisponibiliteEnabled(?bool $isSectionDisponibiliteEnabled): self
    {
        $this->isSectionDisponibiliteEnabled = $isSectionDisponibiliteEnabled;

        return $this;
    }

    public function getNombreArticlesPublier(): ?int
    {
        return $this->nombreArticlesPublier;
    }

    public function setNombreArticlesPublier(?int $nombreArticlesPublier): self
    {
        $this->nombreArticlesPublier = $nombreArticlesPublier;

        return $this;
    }

    public function getEmailToAdminAfterNewRDV(): ?bool
    {
        return $this->emailToAdminAfterNewRDV;
    }

    public function setEmailToAdminAfterNewRDV(?bool $emailToAdminAfterNewRDV): self
    {
        $this->emailToAdminAfterNewRDV = $emailToAdminAfterNewRDV;

        return $this;
    }

    public function getEmailToClientAfterNewRDV(): ?bool
    {
        return $this->emailToClientAfterNewRDV;
    }

    public function setEmailToClientAfterNewRDV(?bool $emailToClientAfterNewRDV): self
    {
        $this->emailToClientAfterNewRDV = $emailToClientAfterNewRDV;

        return $this;
    }

    public function getSmsToClientAfterNewRDV(): ?bool
    {
        return $this->smsToClientAfterNewRDV;
    }

    public function setSmsToClientAfterNewRDV(?bool $smsToClientAfterNewRDV): self
    {
        $this->smsToClientAfterNewRDV = $smsToClientAfterNewRDV;

        return $this;
    }

    public function getSmsToAdminAfterNewRDV(): ?bool
    {
        return $this->smsToAdminAfterNewRDV;
    }

    public function setSmsToAdminAfterNewRDV(?bool $smsToAdminAfterNewRDV): self
    {
        $this->smsToAdminAfterNewRDV = $smsToAdminAfterNewRDV;

        return $this;
    }

    public function getEmailToClientAfterNewMailing(): ?bool
    {
        return $this->emailToClientAfterNewMailing;
    }

    public function setEmailToClientAfterNewMailing(?bool $emailToClientAfterNewMailing): self
    {
        $this->emailToClientAfterNewMailing = $emailToClientAfterNewMailing;

        return $this;
    }

    public function getEmailToAdminAfterNewMailing(): ?bool
    {
        return $this->emailToAdminAfterNewMailing;
    }

    public function setEmailToAdminAfterNewMailing(?bool $emailToAdminAfterNewMailing): self
    {
        $this->emailToAdminAfterNewMailing = $emailToAdminAfterNewMailing;

        return $this;
    }

    public function getEmailToAdminAfterNewAddNewsletter(): ?bool
    {
        return $this->emailToAdminAfterNewAddNewsletter;
    }

    public function setEmailToAdminAfterNewAddNewsletter(?bool $emailToAdminAfterNewAddNewsletter): self
    {
        $this->emailToAdminAfterNewAddNewsletter = $emailToAdminAfterNewAddNewsletter;

        return $this;
    }

    public function getEmailToClientAfterNewAddNewsletter(): ?bool
    {
        return $this->emailToClientAfterNewAddNewsletter;
    }

    public function setEmailToClientAfterNewAddNewsletter(?bool $emailToClientAfterNewAddNewsletter): self
    {
        $this->emailToClientAfterNewAddNewsletter = $emailToClientAfterNewAddNewsletter;

        return $this;
    }
}
