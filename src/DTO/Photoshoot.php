<?php


namespace App\DTO;

use App\PhotoshootImage\PhotoshootImageCollection;

class Photoshoot
{
    private $title;
    private $description;
    private $photographer;
    private $model;
    private $isPosted;
    private $publicationDate;
    private $images;

    public function __construct(string $title, string $description,string $photographer,string $model, bool $isPosted, string $publicationDate, PhotoshootImageCollection $images = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->photographer = $photographer;
        $this->model = $model;
        $this->isPosted = $isPosted;
        $this->publicationDate = $publicationDate;
        $this->images = $images;
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

    public function getPublicationDate(): string
    {
        return $this->publicationDate;
    }

    public function getImages(): PhotoshootImageCollection
    {
        return $this->images;
    }
}