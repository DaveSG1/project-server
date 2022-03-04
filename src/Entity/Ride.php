<?php

namespace App\Entity;

use App\Repository\RideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RideRepository::class)
 */
class Ride
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ccaa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ride", cascade={"persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=RideAvailability::class, mappedBy="ride")
     */
    private $rideAvailabilities;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCcaa(): ?string
    {
        return $this->ccaa;
    }

    public function setCcaa(string $ccaa): self
    {
        $this->ccaa = $ccaa;

        return $this;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /*     Ésta función es para que me devuelva todos los datos de cada ruta contenidos en la bbdd. La uso en ApiController en la función getRouteAction.
    La creo aquí por limpieza de código, por no tener todas éstas filas en RideRepository y desde allí enlazarlo con ésto: */

    public function toArray(): array
    {
        return [
            'active' => $this->getActive(),
            'ccaa' => $this->getCcaa(),
            'name' => $this->getName(),
            'location' => $this->getLocation(),
            'address' => $this->getAddress(),
            'telephone' => $this->getTelephone(),
            'description' => $this->getDescription(),
            'duration' => $this->getDuration(),
            'level' => $this->getLevel()
        ];
    }

    /**
     * @return Collection<int, RideAvailability>
     */
    public function getRideAvailabilities(): Collection
    {
        return $this->rideAvailabilities;
    }

    public function addRideAvailability(RideAvailability $rideAvailability): self
    {
        if (!$this->rideAvailabilities->contains($rideAvailability)) {
            $this->rideAvailabilities[] = $rideAvailability;
            $rideAvailability->setRide($this);
        }

        return $this;
    }

    public function removeRideAvailability(RideAvailability $rideAvailability): self
    {
        if ($this->rideAvailabilities->removeElement($rideAvailability)) {
            // set the owning side to null (unless already changed)
            if ($rideAvailability->getRide() === $this) {
                $rideAvailability->setRide(null);
            }
        }

        return $this;
    }
}
