<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 */
class Category
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
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photoshoot", mappedBy="Category")
     */
    private $photoshoots;

    public function __construct()
    {
        $this->photoshoots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|Photoshoot[]
     */
    public function getPhotoshoots(): Collection
    {
        return $this->photoshoots;
    }

    public function addPhotoshoot(Photoshoot $photoshoot): self
    {
        if (!$this->photoshoots->contains($photoshoot)) {
            $this->photoshoots[] = $photoshoot;
            $photoshoot->setCategory($this);
        }

        return $this;
    }

    public function removePhotoshoot(Photoshoot $photoshoot): self
    {
        if ($this->photoshoots->contains($photoshoot)) {
            $this->photoshoots->removeElement($photoshoot);
            // set the owning side to null (unless already changed)
            if ($photoshoot->getCategory() === $this) {
                $photoshoot->setCategory(null);
            }
        }

        return $this;
    }
}
