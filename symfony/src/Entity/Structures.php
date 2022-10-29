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
    private ?string $address = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Franchise $franchise = null;

    #[ORM\OneToOne(inversedBy: 'structures', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $login = null;

    #[ORM\OneToOne(mappedBy: 'structures', cascade: ['persist', 'remove'])]
    private ?PermissionsList $permissionsList = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getFranchise(): ?Franchise
    {
        return $this->franchise;
    }

    public function setFranchise(?Franchise $franchise): self
    {
        $this->franchise = $franchise;

        return $this;
    }

    public function getLogin(): ?Login
    {
        return $this->login;
    }

    public function setLogin(Login $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPermissionsList(): ?PermissionsList
    {
        return $this->permissionsList;
    }

    public function setPermissionsList(PermissionsList $permissionsList): self
    {
        // set the owning side of the relation if necessary
        if ($permissionsList->getStructures() !== $this) {
            $permissionsList->setStructures($this);
        }

        $this->permissionsList = $permissionsList;

        return $this;
    }
}


