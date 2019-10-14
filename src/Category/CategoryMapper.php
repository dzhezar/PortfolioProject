<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

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
