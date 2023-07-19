<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rating = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?Restaurant $restaurant_id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'avis')]
    private ?self $avis_id = null;

    #[ORM\OneToMany(mappedBy: 'avis_id', targetEntity: self::class)]
    private Collection $avis;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }


    public function __toString()
    {

        return  $this->message;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getRestaurantId(): ?Restaurant
    {
        return $this->restaurant_id;
    }

    public function setRestaurantId(?Restaurant $restaurant_id): static
    {
        $this->restaurant_id = $restaurant_id;

        return $this;
    }

    public function getAvisId(): ?self
    {
        return $this->avis_id;
    }

    public function setAvisId(?self $avis_id): static
    {
        $this->avis_id = $avis_id;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(self $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setAvisId($this);
        }

        return $this;
    }

    public function removeAvi(self $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getAvisId() === $this) {
                $avi->setAvisId(null);
            }
        }

        return $this;
    }
}
