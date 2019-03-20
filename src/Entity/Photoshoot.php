<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoshootRepository")
 */
class Photoshoot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Photographer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Model;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhotoshootImage", mappedBy="Photoshoot", orphanRemoval=true)
     */
    private $photoshotImages;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsPosted;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $PublicationDate;

    public function __construct()
    {
        $this->photoshotImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPhotographer(): ?string
    {
        return $this->Photographer;
    }

    public function setPhotographer(string $Photographer): self
    {
        $this->Photographer = $Photographer;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(string $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    /**
     * @return Collection|PhotoshootImage[]
     */
    public function getPhotoshotImages(): Collection
    {
        return $this->photoshotImages;
    }

    public function addPhotoshotImage(PhotoshootImage $photoshotImage): self
    {
        if (!$this->photoshotImages->contains($photoshotImage)) {
            $this->photoshotImages[] = $photoshotImage;
            $photoshotImage->setPhotoshot($this);
        }

        return $this;
    }

    public function removePhotoshotImage(PhotoshootImage $photoshotImage): self
    {
        if ($this->photoshotImages->contains($photoshotImage)) {
            $this->photoshotImages->removeElement($photoshotImage);
            // set the owning side to null (unless already changed)
            if ($photoshotImage->getPhotoshot() === $this) {
                $photoshotImage->setPhotoshot(null);
            }
        }

        return $this;
    }

    public function getIsPosted(): ?bool
    {
        return $this->IsPosted;
    }

    public function setIsPosted(bool $IsPosted): self
    {
        $this->IsPosted = $IsPosted;

        return $this;
    }

    public function getPublicationDate(): ?\DateTime
    {
        return $this->PublicationDate;
    }

    public function setPublicationDate(\DateTime $PublicationDate): self
    {
        $this->PublicationDate = $PublicationDate;

        return $this;
    }
}
