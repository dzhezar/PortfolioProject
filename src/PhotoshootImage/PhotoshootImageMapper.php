<?php


namespace App\PhotoshootImage;



use App\DTO\PhotoshootImage as PhotoshootImageDto;
use App\Entity\PhotoshootImage;
use App\Photoshot\PhotoshootMapper;

class PhotoshootImageMapper
{
    public function entityToDto(PhotoshootImage $entity): PhotoshootImageDto
    {
        $photoshootMapper = new PhotoshootMapper();
        return new PhotoshootImageDto(
            $entity->getImage(),
            $photoshootMapper->entityToDtoWithoutImages($entity->getPhotoshoot())
        );
    }

    public function entityToDtoWithoutPhotoshoot(PhotoshootImage $entity): PhotoshootImageDto
    {
        return new PhotoshootImageDto(
            $entity->getImage()
        );
    }
}