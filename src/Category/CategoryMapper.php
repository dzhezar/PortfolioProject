<?php


namespace App\Category;


use App\DTO\EditCategoryForm;
use App\Entity\Category;

class CategoryMapper
{
    public function entityToFormDto(Category $entity): EditCategoryForm
    {
        return new EditCategoryForm(
            $entity->getName(),
            $entity->getIsVisible()
        );
    }
}