<?php

namespace App\Entity;

use App\Repository\AmiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AmiRepository::class)
 */
class Ami
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
    private $user_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amis_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getValid(): ?int
    {
        return $this->valid;
    }

    public function setValid(?int $valid): self
    {
        $this->valid = $valid;

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
}
