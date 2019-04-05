<?php


namespace App\DTO;


class AddCategoryForm
{
    private $name;

    public function __construct(string $name = null)
    {

        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }


}