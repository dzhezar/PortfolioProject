<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MainPageRepository")
 */
class MainPage
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
    private $MainImage1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MainImage2;

    /**
     * @ORM\Column(type="text")
     */
    private $AboutUs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AboutImage1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AboutImage2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMainImage1(): ?string
    {
        return $this->MainImage1;
    }

    public function setMainImage1(string $MainImage1): self
    {
        $this->MainImage1 = $MainImage1;

        return $this;
    }

    public function getMainImage2(): ?string
    {
        return $this->MainImage2;
    }

    public function setMainImage2(string $MainImage2): self
    {
        $this->MainImage2 = $MainImage2;

        return $this;
    }

    public function getAboutUs(): ?string
    {
        return $this->AboutUs;
    }

    public function setAboutUs(string $AboutUs): self
    {
        $this->AboutUs = $AboutUs;

        return $this;
    }

    public function getAboutImage1(): ?string
    {
        return $this->AboutImage1;
    }

    public function setAboutImage1(string $AboutImage1): self
    {
        $this->AboutImage1 = $AboutImage1;

        return $this;
    }

    public function getAboutImage2(): ?string
    {
        return $this->AboutImage2;
    }

    public function setAboutImage2(string $AboutImage2): self
    {
        $this->AboutImage2 = $AboutImage2;

        return $this;
    }
}
