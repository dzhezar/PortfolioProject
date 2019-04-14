<?php


namespace App\MainPage;


use App\DTO\EditIndexInfoForm;
use App\DTO\IndexInfo;
use App\Entity\MainPage;

class MainPageMapper
{
    public function entityToDtoWithoutImages(MainPage $entity): EditIndexInfoForm
    {
        return new EditIndexInfoForm(
            $entity->getAboutLina(),
            $entity->getAboutKatya()
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