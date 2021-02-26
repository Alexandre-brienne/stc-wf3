<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=SousCategories::class, mappedBy="categories")
     */
    private $sousCategories;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="categories")
     */
    private $User_id;

    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
        $this->User_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|SousCategories[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(SousCategories $sousCategory): self
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories[] = $sousCategory;
            $sousCategory->setCategories($this);
        }

        return $this;
    }

    public function removeSousCategory(SousCategories $sousCategory): self
    {
        if ($this->sousCategories->removeElement($sousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousCategory->getCategories() === $this) {
                $sousCategory->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->User_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->User_id->contains($userId)) {
            $this->User_id[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->User_id->removeElement($userId);

        return $this;
    }

    
    public function __toString()
    {
        return $this->getId();
    }
}
