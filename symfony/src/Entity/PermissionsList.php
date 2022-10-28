<?php

namespace App\Entity;

use App\Repository\PermissionsListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionsListRepository::class)]
class PermissionsList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $drink_sales = null;

    #[ORM\Column]
    private ?bool $food_sale = null;

    #[ORM\Column]
    private ?bool $members_statistics = null;

    #[ORM\Column]
    private ?bool $members_subscription = null;

    #[ORM\Column]
    private ?bool $payment_schedules = null;

    #[ORM\OneToMany(mappedBy: 'permissionsList', targetEntity: Structures::class)]
    private Collection $structure;

    public function __construct()
    {
        $this->structure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isDrinkSales(): ?bool
    {
        return $this->drink_sales;
    }

    public function setDrinkSales(bool $drink_sales): self
    {
        $this->drink_sales = $drink_sales;

        return $this;
    }

    public function isFoodSale(): ?bool
    {
        return $this->food_sale;
    }

    public function setFoodSale(bool $food_sale): self
    {
        $this->food_sale = $food_sale;

        return $this;
    }

    public function isMembersStatistics(): ?bool
    {
        return $this->members_statistics;
    }

    public function setMembersStatistics(bool $members_statistics): self
    {
        $this->members_statistics = $members_statistics;

        return $this;
    }

    public function isMembersSubscription(): ?bool
    {
        return $this->members_subscription;
    }

    public function setMembersSubscription(bool $members_subscription): self
    {
        $this->members_subscription = $members_subscription;

        return $this;
    }

    public function isPaymentSchedules(): ?bool
    {
        return $this->payment_schedules;
    }

    public function setPaymentSchedules(bool $payment_schedules): self
    {
        $this->payment_schedules = $payment_schedules;

        return $this;
    }

    /**
     * @return Collection<int, Structures>
     */
    public function getStructure(): Collection
    {
        return $this->structure;
    }

    public function addStructure(Structures $structure): self
    {
        if (!$this->structure->contains($structure)) {
            $this->structure->add($structure);
            $structure->setPermissionsList($this);
        }

        return $this;
    }

    public function removeStructure(Structures $structure): self
    {
        if ($this->structure->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPermissionsList() === $this) {
                $structure->setPermissionsList(null);
            }
        }

        return $this;
    }
}
