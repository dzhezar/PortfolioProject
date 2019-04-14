<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\HomePage;

use App\Photoshot\PhotoshootCollection;
use App\Photoshot\PhotoshootMapper;
use App\Repository\MainPageRepository;
use App\Repository\Photoshoot\PhotoshootRepository;

class HomePageService implements HomePageServiceInterface
{
    private $photoshootRepository;
    private $mainPageRepository;

    public function __construct(PhotoshootRepository $photoshootRepository, MainPageRepository $mainPageRepository)
    {
        $this->photoshootRepository = $photoshootRepository;
        $this->mainPageRepository = $mainPageRepository;
    }

    public function getPhotoshoots(int $count = null)
    {
        $mainPhotoshoots = $this->photoshootRepository->findNumberOfPhotoshoots($count,['Style','Make-up'],[1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($mainPhotoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function getSneakPeaks(int $count = null)
    {
        $mainSneakPeaks = $this->photoshootRepository->findNumberOfPhotoshoots($count,['Sneak peak'],[1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($mainSneakPeaks as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;

    }

    public function getStylePhotoshoots(int $count =null)
    {
        $photoshoots = $this->photoshootRepository->findNumberOfPhotoshoots($count,['Style'],[1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($photoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function getMuaPhotoshoots(int $count = null)
    {
        $photoshoots = $this->photoshootRepository->findNumberOfPhotoshoots($count, ['Make-up'], [1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($photoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function getMainPageInfo()
    {
        return $this->mainPageRepository->findOneBy([]);
    }
}
