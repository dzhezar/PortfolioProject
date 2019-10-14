<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\MainPage;

use App\DTO\EditIndexInfoForm;
use App\DTO\IndexInfo;
use App\Entity\MainPage;

class MainPageMapper
{
    public function entityToDtoWithoutImages(MainPage $entity): EditIndexInfoForm
    {
        return new EditIndexInfoForm(
            $entity->getAboutMe()
        );
    }

    public function entityToDto(MainPage $entity): IndexInfo
    {
        return new IndexInfo(
            $entity->getMainImage1(),
            $entity->getMainImage2(),
            $entity->getMainImage3()
        );
    }
}
