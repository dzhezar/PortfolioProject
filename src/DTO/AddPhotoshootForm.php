<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\DTO;

use App\Entity\Category;

class AddPhotoshootForm
{
    private $title;
    private $category;
    private $shortDescription;
    private $description;
    private $photographer;
    private $model;
    private $images;

    public function __construct(string $title = null, Category $category = null, string $shortDescription = null, string $description = null, string $photographer = null, string $model = null, $images = null)
    {
        $this->title = $title;
        $this->category = $category;
        $this->shortDescription = $shortDescription;
        $this->description = $description;
        $this->photographer = $photographer;
        $this->model = $model;
        $this->images = $images;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPhotographer(): ?string
    {
        return $this->photographer;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPhotographer(string $photographer): void
    {
        $this->photographer = $photographer;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }
}
