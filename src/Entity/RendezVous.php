<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRendezVous;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureRendezVous;

    /**
     * @ORM\ManyToOne(targetEntity=TeamMember::class)
     */
    private $consultant;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class)
     */
    private $service;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isConfirmer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAnnuler;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isReamenager;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hasTakenPlace;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActif;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isRepondu;

    /**
     * @ORM\OneToMany(targetEntity=Email::class, mappedBy="rendezVousRepondu")
     */
    private $emailsReponses;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $updatedBy;

    /**
     * @ORM\ManyToOne(targetEntity=SiteWeb::class)
     */
    private $siteWeb;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class)
     */
    private $annee;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detail;

    public function __construct()
    {
        $this->emailsReponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDateRendezVous(): ?\DateTimeInterface
    {
        return $this->dateRendezVous;
    }

    public function setDateRendezVous(?\DateTimeInterface $dateRendezVous): self
    {
        $this->dateRendezVous = $dateRendezVous;

        return $this;
    }

    public function getHeureRendezVous(): ?\DateTimeInterface
    {
        return $this->heureRendezVous;
    }

    public function setHeureRendezVous(?\DateTimeInterface $heureRendezVous): self
    {
        $this->heureRendezVous = $heureRendezVous;

        return $this;
    }

    public function getConsultant(): ?TeamMember
    {
        return $this->consultant;
    }

    public function setConsultant(?TeamMember $consultant): self
    {
        $this->consultant = $consultant;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getIsConfirmer(): ?bool
    {
        return $this->isConfirmer;
    }

    public function setIsConfirmer(?bool $isConfirmer): self
    {
        $this->isConfirmer = $isConfirmer;

        return $this;
    }

    public function getIsAnnuler(): ?bool
    {
        return $this->isAnnuler;
    }

    public function setIsAnnuler(?bool $isAnnuler): self
    {
        $this->isAnnuler = $isAnnuler;

        return $this;
    }

    public function getIsReamenager(): ?bool
    {
        return $this->isReamenager;
    }

    public function setIsReamenager(?bool $isReamenager): self
    {
        $this->isReamenager = $isReamenager;

        return $this;
    }

    public function getHasTakenPlace(): ?bool
    {
        return $this->hasTakenPlace;
    }

    public function setHasTakenPlace(?bool $hasTakenPlace): self
    {
        $this->hasTakenPlace = $hasTakenPlace;

        return $this;
    }

    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(?bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }

    public function getIsLu(): ?bool
    {
        return $this->isLu;
    }

    public function setIsLu(?bool $isLu): self
    {
        $this->isLu = $isLu;

        return $this;
    }

    public function getIsRepondu(): ?bool
    {
        return $this->isRepondu;
    }

    public function setIsRepondu(?bool $isRepondu): self
    {
        $this->isRepondu = $isRepondu;

        return $this;
    }

    /**
     * @return Collection|Email[]
     */
    public function getEmailsReponses(): Collection
    {
        return $this->emailsReponses;
    }

    public function addEmailsReponse(Email $emailsReponse): self
    {
        if (!$this->emailsReponses->contains($emailsReponse)) {
            $this->emailsReponses[] = $emailsReponse;
            $emailsReponse->setRendezVousRepondu($this);
        }

        return $this;
    }

    public function removeEmailsReponse(Email $emailsReponse): self
    {
        if ($this->emailsReponses->removeElement($emailsReponse)) {
            // set the owning side to null (unless already changed)
            if ($emailsReponse->getRendezVousRepondu() === $this) {
                $emailsReponse->setRendezVousRepondu(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

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

    public function getAnnee(): ?Annee
    {
        return $this->annee;
    }

    public function setAnnee(?Annee $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }
}
