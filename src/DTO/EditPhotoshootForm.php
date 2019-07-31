<?php


namespace App\DTO;


use App\Entity\Category;

class EditPhotoshootForm
{
    private $title;
    private $category;
    private $shortDescription;
    private $backstage;

    public function __construct(string $title = null, Category $category = null, string $shortDescription = null, bool $backstage = null)
    {
        $this->title = $title;
        $this->category = $category;
        $this->shortDescription = $shortDescription;
        $this->backstage = $backstage;
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

    public function isBackstage(): ?bool
    {
        return $this->backstage;
    }

    public function setBackstage(bool $backstage): void
    {
        $this->backstage = $backstage;
    }

}