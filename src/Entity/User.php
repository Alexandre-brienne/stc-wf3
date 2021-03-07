<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"}, message="je suis vraiment dessolé mais ce pseudo existe déja :(")
 * @UniqueEntity(fields={"email"}, message="je suis vraiment dessolé mais l'adresse existe déja :(")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     * 
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * 
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, columnDefinition="enum('Homme','Femme','Autre')")
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $point;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_inscription;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_connexion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recherche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $situation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dapartement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_fond;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cheveux;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $astrologique;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amis_id;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_profil;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, inversedBy="users")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Messagerie::class, mappedBy="expediteur")
     */
    private $messageries;

    /**
     * @ORM\OneToMany(targetEntity=Messagerie::class, mappedBy="destinataire")
     */
    private $Userdestinataire;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->messageries = new ArrayCollection();
        $this->Userdestinataire = new ArrayCollection();
    }

  
  

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *@Groups({"user"})
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
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

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function setPoint(?int $point): self
    {
        $this->point = $point;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getDateConnexion(): ?\DateTimeInterface
    {
        return $this->date_connexion;
    }

    public function setDateConnexion(?\DateTimeInterface $date_connexion): self
    {
        $this->date_connexion = $date_connexion;

        return $this;
    }

    public function getRecherche(): ?string
    {
        return $this->recherche;
    }

    public function setRecherche(?string $recherche): self
    {
        $this->recherche = $recherche;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(?string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDapartement(): ?string
    {
        return $this->dapartement;
    }

    public function setDapartement(?string $dapartement): self
    {
        $this->dapartement = $dapartement;

        return $this;
    }

    public function getImageFond(): ?string
    {
        return $this->image_fond;
    }

    public function setImageFond(?string $image_fond): self
    {
        $this->image_fond = $image_fond;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(?int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCheveux(): ?string
    {
        return $this->cheveux;
    }

    public function setCheveux(?string $cheveux): self
    {
        $this->cheveux = $cheveux;

        return $this;
    }

    public function getAstrologique(): ?string
    {
        return $this->astrologique;
    }

    public function setAstrologique(?string $astrologique): self
    {
        $this->astrologique = $astrologique;

        return $this;
    }

    public function getAmisId(): ?int
    {
        return $this->amis_id;
    }

    public function setAmisId(?int $amis_id): self
    {
        $this->amis_id = $amis_id;

        return $this;
    }

   
    public function __toString()
    {
        return $this->getId();
    }


    public function getImageProfil(): ?string
    {
        return $this->image_profil;
    }

    public function setImageProfil(?string $image_profil): self
    {
        $this->image_profil = $image_profil;

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addUser($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Messagerie[]
     */
    public function getMessageries(): Collection
    {
        return $this->messageries;
    }

    public function addMessagery(Messagerie $messagery): self
    {
        if (!$this->messageries->contains($messagery)) {
            $this->messageries[] = $messagery;
            $messagery->setExpediteur($this);
        }

        return $this;
    }

    public function removeMessagery(Messagerie $messagery): self
    {
        if ($this->messageries->removeElement($messagery)) {
            // set the owning side to null (unless already changed)
            if ($messagery->getExpediteur() === $this) {
                $messagery->setExpediteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Messagerie[]
     */
    public function getUserdestinataire(): Collection
    {
        return $this->Userdestinataire;
    }

    public function addUserdestinataire(Messagerie $userdestinataire): self
    {
        if (!$this->Userdestinataire->contains($userdestinataire)) {
            $this->Userdestinataire[] = $userdestinataire;
            $userdestinataire->setDestinataire($this);
        }

        return $this;
    }

    public function removeUserdestinataire(Messagerie $userdestinataire): self
    {
        if ($this->Userdestinataire->removeElement($userdestinataire)) {
            // set the owning side to null (unless already changed)
            if ($userdestinataire->getDestinataire() === $this) {
                $userdestinataire->setDestinataire(null);
            }
        }

        return $this;
    }


  
    
}
