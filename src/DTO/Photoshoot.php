<?php


namespace App\DTO;

use App\PhotoshootImage\PhotoshootImageCollection;

class Photoshoot
{
    private $id;
    private $title;
    private $description;
    private $photographer;
    private $model;
    private $isPosted;
    private $publicationDate;
    private $images;

    public function __construct(int $id, string $title, string $description,string $photographer,string $model, bool $isPosted, \DateTime $publicationDate, PhotoshootImageCollection $images = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
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

    public function getDescription(): string
    {
        return $this->description;
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