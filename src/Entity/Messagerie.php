<?php

namespace App\Entity;

use App\Repository\MessagerieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MessagerieRepository::class)
 */
class Messagerie 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expediteur_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $destinataire_id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_envoi;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messageries")
     * @Groups("expediteur")
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Userdestinataire")
     * @Groups("expediteur")
     */
    private $destinataire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExpediteurId(): ?int
    {
        return $this->expediteur_id;
    }

    public function setExpediteurId(?int $expediteur_id): self
    {
        $this->expediteur_id = $expediteur_id;

        return $this;
    }

    public function getDestinataireId(): ?int
    {
        return $this->destinataire_id;
    }

    public function setDestinataireId(?int $destinataire_id): self
    {
        $this->destinataire_id = $destinataire_id;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->date_envoi;
    }

    public function setDateEnvoi(?\DateTimeInterface $date_envoi): self
    {
        $this->date_envoi = $date_envoi;

        return $this;
    }

    public function getExpediteur(): ?User
    {
        return $this->expediteur;
    }
    

    public function setExpediteur(?User $expediteur): self
    {
        $this->expediteur = $expediteur;

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


   
    
}
