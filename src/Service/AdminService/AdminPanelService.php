<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\AdminService;

use App\MainPage\MainPageMapper;
use App\Photoshot\PhotoshootCollection;
use App\Photoshot\PhotoshootMapper;
use App\Repository\MainPageRepository;
use App\Repository\Photoshoot\PhotoshootRepository;
use App\Repository\PhotoshootImage\PhotoshootImageRepository;
use Doctrine\ORM\EntityManagerInterface;

class AdminPanelService implements AdminPanelServiceInterface
{
    private $photoshootRepository;
    private $imageRepository;
    private $em;
    private $indexRepository;

    public function __construct(PhotoshootRepository $photoshootRepository, PhotoshootImageRepository $imageRepository, EntityManagerInterface $em, MainPageRepository $indexRepository)
    {
        $this->photoshootRepository = $photoshootRepository;
        $this->imageRepository = $imageRepository;
        $this->em = $em;
        $this->indexRepository = $indexRepository;
    }


    public function getPhotoshoots(): PhotoshootCollection
    {
        $photoshoots = $this->photoshootRepository->findAllPhotoshoots();
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($photoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function setIsPosted(int $id, int $val)
    {
        $photoshoot = $this->photoshootRepository->findOneBy(['id' => $id]);

        $photoshoot->setIsPosted($val);
        $this->em->persist($photoshoot);
        $this->em->flush();
    }

    public function getPhotoshootById(int $id)
    {
        $photoshoot = $this->photoshootRepository->findOneBy(['id' => $id]);
        $mapper = new PhotoshootMapper();
        return $mapper->entityToEditFormDto($photoshoot);

    }

    public function getPhotoshootsByCategory(string $category, int $count = null): PhotoshootCollection
    {
        $photoshoots = $this->photoshootRepository->findNumberOfPhotoshoots($count,[$category],[0,1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($photoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function getIndexInfo()
    {
        $indexInfo = $this->indexRepository->findOneBy([]);

        $mainPageMapper = new MainPageMapper();

        return $mainPageMapper->entityToDtoWithoutImages($indexInfo);
    }


    public function getIndexImg()
    {
        $indexImg = $this->indexRepository->findOneBy([]);

        $mainPageMapper = new MainPageMapper();

        return $mainPageMapper->entityToDto($indexImg);
    }

    public function getBackstages(): PhotoshootCollection
    {
        $backstages = $this->photoshootRepository->findBy(['Backstage' => true]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($backstages as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }
}
