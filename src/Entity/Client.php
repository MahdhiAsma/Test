<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @Groups({ "lien","client" })
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({ "lien" ,"client"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({ "lien" ,"client"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @Groups("client_detail")
     * @ORM\OneToMany(targetEntity=Lien::class, mappedBy="client", orphanRemoval=true)
     */
    private $purchase;

 





    public function __construct()
    {
        $this->purchase = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

 


    public function __toString(){
 
        return  $this->getName();
    }

    /**
     * @return Collection<int, Lien>
     */
    public function getPurchase(): Collection
    {
        return $this->purchase;
    }

    public function addPurchase(Lien $purchase): self
    {
        if (!$this->purchase->contains($purchase)) {
            $this->purchase[] = $purchase;
            $purchase->setClient($this);
        }

        return $this;
    }

    public function removePurchase(Lien $purchase): self
    {
        if ($this->purchase->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getClient() === $this) {
                $purchase->setClient(null);
            }
        }

        return $this;
    }


}
