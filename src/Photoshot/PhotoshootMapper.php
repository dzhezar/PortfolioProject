<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Photoshot;

use App\DTO\EditPhotoshootForm;
use App\DTO\Photoshoot as PhotoshotDto;
use App\Entity\Photoshoot;
use App\PhotoshootImage\PhotoshootImageCollection;
use App\PhotoshootImage\PhotoshootImageMapper;
use App\Repository\PhotoshootImage\PhotoshootImageRepository;

class PhotoshootMapper
{
    private $imageRepository;

    /**
     * PhotoshootMapper constructor.
     * @param $imageRepository
     */
    public function __construct(PhotoshootImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }


    public function entityToDto(Photoshoot $entity): PhotoshotDto
    {
        $imagesMapper = new PhotoshootImageMapper();
        $collection = new PhotoshootImageCollection();
        $images = $this->imageRepository->findBy(['Photoshoot' => $entity],['queue' => 'asc']);
        foreach ($images as $image) {
            $collection->addPhotoshot($imagesMapper->entityToDtoWithoutPhotoshoot($image));
        }

        return new PhotoshotDto(
            $entity->getId(),
            $entity->getCategory(),
            $entity->getTitle(),
            $entity->getShortDescription(),
            $entity->getIsPosted(),
            $entity->getPublicationDate(),
            $entity->getSlug(),
            $collection
        );
    }

    public function entityToDtoWithoutImages(Photoshoot $entity): PhotoshotDto
    {
        return new PhotoshotDto(
            $entity->getId(),
            $entity->getCategory(),
            $entity->getTitle(),
            $entity->getShortDescription(),
            $entity->getIsPosted(),
            $entity->getPublicationDate(),
            $entity->getSlug()
        );
    }

    public function entityToEditFormDto(Photoshoot $entity): EditPhotoshootForm
    {
        return new EditPhotoshootForm(
            $entity->getTitle(),
            $entity->getCategory(),
            $entity->getShortDescription()
        );
    }
}
