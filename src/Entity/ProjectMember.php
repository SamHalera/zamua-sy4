<?php

namespace App\Entity;

use App\Repository\ProjectMemberRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectMemberRepository::class)
 */
class ProjectMember
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Give at least an Artist Name")
     */
    private $artistName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Specify what this artist does")
     */
    private $features;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featuresIt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featuresFr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getArtistName(): ?string
    {
        return $this->artistName;
    }

    public function setArtistName(?string $artistName): self
    {
        $this->artistName = $artistName;

        return $this;
    }

    public function getFeatures(): ?string
    {
        return $this->features;
    }

    public function setFeatures(string $features): self
    {
        $this->features = $features;

        return $this;
    }

    public function __toString()
    {
        if($this->getArtistName()){
            return $this->getArtistName();
        } else {
            return $this->getFirstName() . ' ' . $this->getLastName();
        }
    }

    public function getFeaturesIt(): ?string
    {
        return $this->featuresIt;
    }

    public function setFeaturesIt(?string $featuresIt): self
    {
        $this->featuresIt = $featuresIt;

        return $this;
    }

    public function getFeaturesFr(): ?string
    {
        return $this->featuresFr;
    }

    public function setFeaturesFr(?string $featuresFr): self
    {
        $this->featuresFr = $featuresFr;

        return $this;
    }
}
