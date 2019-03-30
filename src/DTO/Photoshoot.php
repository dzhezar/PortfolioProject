<?php


namespace App\DTO;

use App\Entity\Category;
use App\PhotoshootImage\PhotoshootImageCollection;

class Photoshoot
{
    private $id;
    private $category;
    private $title;
    private $description;
    private $shortDescription;
    private $photographer;
    private $model;
    private $isPosted;
    private $publicationDate;
    private $images;

    public function __construct(int $id, Category $category, string $title, string $description,string $shortDescription, string $photographer,string $model, bool $isPosted, \DateTime $publicationDate, PhotoshootImageCollection $images=null)
    {
        $this->id = $id;
        $this->category = $category;
        $this->title = $title;
        $this->description = $description;
        $this->shortDescription = $shortDescription;
        $this->photographer = $photographer;
        $this->model = $model;
        $this->isPosted = $isPosted;
        $this->publicationDate = $publicationDate;
        $this->images = $images;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    public function getPhotographer(): string
    {
        return $this->photographer;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function isPosted(): bool
    {
        return $this->isPosted;
    }

    public function getPublicationDate(): \DateTime
    {
        return $this->publicationDate;
    }

    public function getImages(): PhotoshootImageCollection
    {
        return $this->images;
    }
}