<?php

namespace App\Entity;

use App\Repository\ProjectTranslationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectTranslationRepository::class)
 */
class ProjectTranslation
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
    private $language;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainTitleTrans;

    /**
     * @ORM\Column(type="text")
     */
    private $contentTrans;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="translations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getMainTitleTrans(): ?string
    {
        return $this->mainTitleTrans;
    }

    public function setMainTitleTrans(string $mainTitleTrans): self
    {
        $this->mainTitleTrans = $mainTitleTrans;

        return $this;
    }

    public function getContentTrans(): ?string
    {
        return $this->contentTrans;
    }

    public function setContentTrans(string $contentTrans): self
    {
        $this->contentTrans = $contentTrans;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
