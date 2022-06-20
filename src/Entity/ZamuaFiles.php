<?php

namespace App\Entity;

use App\Repository\ZamuaFilesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZamuaFilesRepository::class)
 */
class ZamuaFiles
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
    private $fileName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isGalleryItem;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, inversedBy="zamuaFiles")
     */
    private $projects;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priority;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alt;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $credit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $caption;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $creditLink;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getIsGalleryItem(): ?bool
    {
        return $this->isGalleryItem;
    }

    public function setIsGalleryItem(bool $isGalleryItem): self
    {
        $this->isGalleryItem = $isGalleryItem;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        $this->projects->removeElement($project);

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    
    public function getCredit(): ?string
    {
        return $this->credit;
    }

    public function setCredit(?string $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getFilePath()
    {
        return 'uploads/' . self::UPLOADS_FILES_FOLDER . '/' . $this->getFileName();
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getCreditLink(): ?string
    {
        return $this->creditLink;
    }

    public function setCreditLink(?string $creditLink): self
    {
        $this->creditLink = $creditLink;

        return $this;
    }
    public function __toString()
    {
        return $this->getCredit();
    }
}
