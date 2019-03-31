<?php


namespace App\DTO;


use App\Entity\Category;

class EditPhotoshootForm
{
    private $title;
    private $category;
    private $shortDescription;
    private $description;
    private $photographer;
    private $model;

    public function __construct(string $title = null, Category $category = null, string $shortDescription = null, string $description = null, string $photographer = null, string $model = null)
    {
        $this->title = $title;
        $this->category = $category;
        $this->shortDescription = $shortDescription;
        $this->description = $description;
        $this->photographer = $photographer;
        $this->model = $model;
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
}