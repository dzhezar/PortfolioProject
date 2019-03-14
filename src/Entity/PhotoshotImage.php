<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoshotImageRepository")
 */
class PhotoshotImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Photoshot", inversedBy="photoshotImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Photoshot;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhotoshot(): ?Photoshot
    {
        return $this->Photoshot;
    }

    public function setPhotoshot(?Photoshot $Photoshot): self
    {
        $this->Photoshot = $Photoshot;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
