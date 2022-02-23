<?php

namespace App\Entity;

use App\Repository\LienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LienRepository::class)
 */
class Lien
{
    /**
    * @Groups("lien")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({ "lien" })
     * @ORM\ManyToMany(targetEntity=Equipement::class, inversedBy="liens")
     */
    private $Equipement;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="purchase")
     * @Groups({ "lien" })
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @Groups({ "lien" })
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function __construct()
    {
        $this->Equipement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipement(): Collection
    {
        return $this->Equipement;
    }

    public function addEquipement(Equipement $equipement): self
    {
        if (!$this->Equipement->contains($equipement)) {
            $this->Equipement[] = $equipement;
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): self
    {
        $this->Equipement->removeElement($equipement);

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
