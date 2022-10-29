<?php

namespace App\Entity;

use App\Repository\PermissionsListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionsListRepository::class)]
class PermissionsList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'permissionsList', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Structures $structures = null;

    #[ORM\Column(nullable: true)]
    private ?bool $drinkSales = null;

    #[ORM\Column(nullable: true)]
    private ?bool $foodSales = null;

    #[ORM\Column(nullable: true)]
    private ?bool $membersStatistics = null;

    #[ORM\Column(nullable: true)]
    private ?bool $membersSubscriptions = null;

    #[ORM\Column(nullable: true)]
    private ?bool $paymentSchedules = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStructures(): ?Structures
    {
        return $this->structures;
    }

    public function setStructures(Structures $structures): self
    {
        $this->structures = $structures;

        return $this;
    }

    public function isDrinkSales(): ?bool
    {
        return $this->drinkSales;
    }

    public function setDrinkSales(?bool $drinkSales): self
    {
        $this->drinkSales = $drinkSales;

        return $this;
    }

    public function isFoodSales(): ?bool
    {
        return $this->foodSales;
    }

    public function setFoodSales(?bool $foodSales): self
    {
        $this->foodSales = $foodSales;

        return $this;
    }

    public function isMembersStatistics(): ?bool
    {
        return $this->membersStatistics;
    }

    public function setMembersStatistics(?bool $membersStatistics): self
    {
        $this->membersStatistics = $membersStatistics;

        return $this;
    }

    public function isMembersSubscriptions(): ?bool
    {
        return $this->membersSubscriptions;
    }

    public function setMembersSubscriptions(?bool $membersSubscriptions): self
    {
        $this->membersSubscriptions = $membersSubscriptions;

        return $this;
    }

    public function isPaymentSchedules(): ?bool
    {
        return $this->paymentSchedules;
    }

    public function setPaymentSchedules(?bool $paymentSchedules): self
    {
        $this->paymentSchedules = $paymentSchedules;

        return $this;
    }
}
