<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\HomePage;

use App\Entity\MainPage;
use App\MainPage\MainPageMapper;
use App\Photoshot\PhotoshootCollection;
use App\Photoshot\PhotoshootMapper;
use App\Repository\Category\CategoryRepository;
use App\Repository\MainPageRepository;
use App\Repository\Photoshoot\PhotoshootRepository;

class HomePageService implements HomePageServiceInterface
{
    private $photoshootRepository;
    private $mainPageRepository;
    private $categoryRepository;

    public function __construct(PhotoshootRepository $photoshootRepository, MainPageRepository $mainPageRepository, CategoryRepository $categoryRepository)
    {
        $this->photoshootRepository = $photoshootRepository;
        $this->mainPageRepository = $mainPageRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getPhotoshoots(int $count = null)
    {
        $mainPhotoshoots = $this->photoshootRepository->findBy(['IsPosted' => true], ['PublicationDate' => 'desc'], $count);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($mainPhotoshoots as $item) {
            if (true == $item->getCategory()->getIsVisible()) {
                $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
            }
        }

        return $collection;
    }

    public function getSneakPeaks(int $count = null)
    {
        $mainSneakPeaks = $this->photoshootRepository->findBy(['IsPosted' => true], ['PublicationDate' => 'desc'], $count);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($mainSneakPeaks as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function getPhotoshootsByCategory(string $slug, int $count = null)
    {
        $category = $this->categoryRepository->findOneBy(['slug' => $slug]);
        $mainSneakPeaks = $this->photoshootRepository->findBy(['IsPosted' => true, 'Category' => $category], ['PublicationDate' => 'desc'], $count);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($mainSneakPeaks as $item) {
            if (true == $item->getCategory()->getIsVisible()) {
                $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
            }
        }

        return $collection;
    }

    public function getMainPageInfo()
    {
        return $this->mainPageRepository->findOneBy([]) ?? new MainPage();
    }

    public function getIndexImg()
    {
        $indexImg = $this->mainPageRepository->findOneBy([]) ?? new MainPage();
        $mainPageMapper = new MainPageMapper();

        return $mainPageMapper->entityToDto($indexImg);
    }
}
