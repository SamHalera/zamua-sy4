<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaylistRepository::class)
 */
class Playlist
{
    const UPLOADS_FILES_FOLDER = 'files';
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     * * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @ORM\Column(type="text")
     */
    private $iframe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleFR;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleIT;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionFR;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionIT;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getIframe(): ?string
    {
        return $this->iframe;
    }

    public function setIframe(string $iframe): self
    {
        $this->iframe = $iframe;

        return $this;
    }

    public function getTitleFR(): ?string
    {
        return $this->titleFR;
    }

    public function setTitleFR(string $titleFR): self
    {
        $this->titleFR = $titleFR;

        return $this;
    }

    public function getTitleIT(): ?string
    {
        return $this->titleIT;
    }

    public function setTitleIT(string $titleIT): self
    {
        $this->titleIT = $titleIT;

        return $this;
    }

    public function getDescriptionFR(): ?string
    {
        return $this->descriptionFR;
    }

    public function setDescriptionFR(string $descriptionFR): self
    {
        $this->descriptionFR = $descriptionFR;

        return $this;
    }

    public function getDescriptionIT(): ?string
    {
        return $this->descriptionIT;
    }

    public function setDescriptionIT(string $descriptionIT): self
    {
        $this->descriptionIT = $descriptionIT;

        return $this;
    }

    

    
}
