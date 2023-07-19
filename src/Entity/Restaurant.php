<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
class Restaurant
{

    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'restaurants')]
    private ?Ville $ville_id = null;

    #[ORM\ManyToOne(inversedBy: 'restaurants')]
    private ?User $user_id = null;

    #[ORM\OneToMany(mappedBy: 'restaurant_id', targetEntity: RestaurantPicture::class)]
    private Collection $restaurantPictures;

    #[ORM\OneToMany(mappedBy: 'restaurant_id', targetEntity: Avis::class)]
    private Collection $avis;

    public function __construct()
    {
        $this->restaurantPictures = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function __toString()
    {

        return  $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVilleId(): ?Ville
    {
        return $this->ville_id;
    }

    public function setVilleId(?Ville $ville_id): static
    {
        $this->ville_id = $ville_id;

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

    /**
     * @return Collection<int, RestaurantPicture>
     */
    public function getRestaurantPictures(): Collection
    {
        return $this->restaurantPictures;
    }

    public function addRestaurantPicture(RestaurantPicture $restaurantPicture): static
    {
        if (!$this->restaurantPictures->contains($restaurantPicture)) {
            $this->restaurantPictures->add($restaurantPicture);
            $restaurantPicture->setRestaurantId($this);
        }

        return $this;
    }

    public function removeRestaurantPicture(RestaurantPicture $restaurantPicture): static
    {
        if ($this->restaurantPictures->removeElement($restaurantPicture)) {
            // set the owning side to null (unless already changed)
            if ($restaurantPicture->getRestaurantId() === $this) {
                $restaurantPicture->setRestaurantId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setRestaurantId($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getRestaurantId() === $this) {
                $avi->setRestaurantId(null);
            }
        }

        return $this;
    }
}
