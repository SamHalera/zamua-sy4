<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShowRepository::class)
 * @ORM\Table(name="`show`")
 */
class Show
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $venue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPassed;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCancelled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $venueUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locationUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ticketUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVenue(): ?string
    {
        return $this->venue;
    }

    public function setVenue(?string $venue): self
    {
        $this->venue = $venue;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsPassed(): ?bool
    {
        return $this->isPassed;
    }

    public function setIsPassed(bool $isPassed): self
    {
        $this->isPassed = $isPassed;

        return $this;
    }

    public function getIsCancelled(): ?bool
    {
        return $this->isCancelled;
    }

    public function setIsCancelled(bool $isCancelled): self
    {
        $this->isCancelled = $isCancelled;

        return $this;
    }

    public function getVenueUrl(): ?string
    {
        return $this->venueUrl;
    }

    public function setVenueUrl(?string $venueUrl): self
    {
        $this->venueUrl = $venueUrl;

        return $this;
    }

    public function getLocationUrl(): ?string
    {
        return $this->locationUrl;
    }

    public function setLocationUrl(?string $locationUrl): self
    {
        $this->locationUrl = $locationUrl;

        return $this;
    }

    public function getTicketUrl(): ?string
    {
        return $this->ticketUrl;
    }

    public function setTicketUrl(?string $ticketUrl): self
    {
        $this->ticketUrl = $ticketUrl;

        return $this;
    }
}
