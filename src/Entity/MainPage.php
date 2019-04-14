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
     * @ORM\Column(type="string", length=255)
     */
    private $MainImage3;

    /**
     * @ORM\Column(type="text")
     */
    private $AboutLina;

    /**
     * @ORM\Column(type="text")
     */
    private $AboutKatya;



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

    public function getMainImage3(): ?string
    {
        return $this->MainImage3;
    }

    public function setMainImage3(string $MainImage3): self
    {
        $this->MainImage3 = $MainImage3;

        return $this;
    }

    public function getAboutLina(): ?string
    {
        return $this->AboutLina;
    }

    public function setAboutLina(string $AboutLina): self
    {
        $this->AboutLina = $AboutLina;

        return $this;
    }

    public function getAboutKatya(): ?string
    {
        return $this->AboutKatya;
    }

    public function setAboutKatya(string $AboutKatya): self
    {
        $this->AboutKatya = $AboutKatya;

        return $this;
    }
}
