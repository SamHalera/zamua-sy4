<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondTitle;

    /**
     * @ORM\ManyToMany(targetEntity=ProjectMember::class)
     */
    private $members;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @ORM\ManyToMany(targetEntity=ZamuaFiles::class, mappedBy="projects")
     */
    private $zamuaFiles;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->zamuaFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMainTitle(): ?string
    {
        return $this->mainTitle;
    }

    public function setMainTitle(string $mainTitle): self
    {
        $this->mainTitle = $mainTitle;

        return $this;
    }

    public function getFirstTitle(): ?string
    {
        return $this->firstTitle;
    }

    public function setFirstTitle(?string $firstTitle): self
    {
        $this->firstTitle = $firstTitle;

        return $this;
    }

    public function getSecondTitle(): ?string
    {
        return $this->secondTitle;
    }

    public function setSecondTitle(?string $secondTitle): self
    {
        $this->secondTitle = $secondTitle;

        return $this;
    }

    /**
     * @return Collection<int, ProjectMember>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(ProjectMember $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
        }

        return $this;
    }

    public function removeMember(ProjectMember $member): self
    {
        $this->members->removeElement($member);

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, ZamuaFiles>
     */
    public function getZamuaFiles(): Collection
    {
        return $this->zamuaFiles;
    }

    public function addZamuaFile(ZamuaFiles $zamuaFile): self
    {
        if (!$this->zamuaFiles->contains($zamuaFile)) {
            $this->zamuaFiles[] = $zamuaFile;
            $zamuaFile->addProject($this);
        }

        return $this;
    }

    public function removeZamuaFile(ZamuaFiles $zamuaFile): self
    {
        if ($this->zamuaFiles->removeElement($zamuaFile)) {
            $zamuaFile->removeProject($this);
        }

        return $this;
    }
}
