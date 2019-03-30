<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Photoshot;

use App\DTO\Photoshoot as PhotoshotDto;
use App\Entity\Photoshoot;
use App\PhotoshootImage\PhotoshootImageCollection;
use App\PhotoshootImage\PhotoshootImageMapper;

class PhotoshootMapper
{
    public function entityToDto(Photoshoot $entity): PhotoshotDto
    {
        $imagesMapper = new PhotoshootImageMapper();
        $collection = new PhotoshootImageCollection();
        $images = $entity->getPhotoshootImages();

        foreach ($images as $image) {
            $collection->addPhotoshot($imagesMapper->entityToDtoWithoutPhotoshoot($image));
        }

        return new PhotoshotDto(
            $entity->getId(),
            $entity->getCategory(),
            $entity->getTitle(),
            $entity->getDescription(),
            $entity->getShortDescription(),
            $entity->getPhotographer(),
            $entity->getModel(),
            $entity->getIsPosted(),
            $entity->getPublicationDate(),
            $collection
        );
    }

    public function entityToDtoWithoutImages(Photoshoot $entity): PhotoshotDto
    {
        return new PhotoshotDto(
            $entity->getId(),
            $entity->getCategory(),
            $entity->getTitle(),
            $entity->getDescription(),
            $entity->getShortDescription(),
            $entity->getPhotographer(),
            $entity->getModel(),
            $entity->getIsPosted(),
            $entity->getPublicationDate()
        );
    }
}
