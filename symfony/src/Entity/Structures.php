<?php

namespace App\Entity;

use App\Repository\StructuresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructuresRepository::class)]
class Structures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Franchise $id_franchise = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getIdFranchise(): ?Franchise
    {
        return $this->id_franchise;
    }

    public function setIdFranchise(?Franchise $id_franchise): self
    {
        $this->id_franchise = $id_franchise;

        return $this;
    }
}
