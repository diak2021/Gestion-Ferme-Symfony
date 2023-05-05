<?php

namespace App\Entity;

use App\Repository\EmailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmailRepository::class)
 */
class Email
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $emetteur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $destinataire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objet;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $corps;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $emailSender;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $emailReceiver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMailEntrant;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMailSortant;

    /**
     * @ORM\ManyToOne(targetEntity=Email::class, inversedBy="reponses")
     */
    private $emailRepondu;

    /**
     * @ORM\OneToMany(targetEntity=Email::class, mappedBy="emailRepondu")
     */
    private $reponses;

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
     * @ORM\ManyToOne(targetEntity=RendezVous::class, inversedBy="emailsReponses")
     */
    private $rendezVousRepondu;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmetteur(): ?User
    {
        return $this->emetteur;
    }

    public function setEmetteur(?User $emetteur): self
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    public function getDestinataire(): ?User
    {
        return $this->destinataire;
    }

    public function setDestinataire(?User $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getCorps(): ?string
    {
        return $this->corps;
    }

    public function setCorps(?string $corps): self
    {
        $this->corps = $corps;

        return $this;
    }

    public function getEmailSender(): ?string
    {
        return $this->emailSender;
    }

    public function setEmailSender(?string $emailSender): self
    {
        $this->emailSender = $emailSender;

        return $this;
    }

    public function getEmailReceiver(): ?string
    {
        return $this->emailReceiver;
    }

    public function setEmailReceiver(?string $emailReceiver): self
    {
        $this->emailReceiver = $emailReceiver;

        return $this;
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

    public function getIsLu(): ?bool
    {
        return $this->isLu;
    }

    public function setIsLu(?bool $isLu): self
    {
        $this->isLu = $isLu;

        return $this;
    }

    public function getIsMailEntrant(): ?bool
    {
        return $this->isMailEntrant;
    }

    public function setIsMailEntrant(?bool $isMailEntrant): self
    {
        $this->isMailEntrant = $isMailEntrant;

        return $this;
    }

    public function getIsMailSortant(): ?bool
    {
        return $this->isMailSortant;
    }

    public function setIsMailSortant(?bool $isMailSortant): self
    {
        $this->isMailSortant = $isMailSortant;

        return $this;
    }

    public function getEmailRepondu(): ?self
    {
        return $this->emailRepondu;
    }

    public function setEmailRepondu(?self $emailRepondu): self
    {
        $this->emailRepondu = $emailRepondu;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(self $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setEmailRepondu($this);
        }

        return $this;
    }

    public function removeReponse(self $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getEmailRepondu() === $this) {
                $reponse->setEmailRepondu(null);
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

    public function getRendezVousRepondu(): ?RendezVous
    {
        return $this->rendezVousRepondu;
    }

    public function setRendezVousRepondu(?RendezVous $rendezVousRepondu): self
    {
        $this->rendezVousRepondu = $rendezVousRepondu;

        return $this;
    }
}
