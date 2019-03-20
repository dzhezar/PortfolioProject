<?php


namespace App\Service\HomePage;


use App\Photoshot\PhotoshootCollection;
use App\Photoshot\PhotoshootMapper;
use App\Repository\Photoshoot\PhotoshootRepository;

class HomePageService implements HomePageServiceInterface
{
    private $photoshootRepository;

    public function __construct(PhotoshootRepository $photoshootRepository)
    {
        $this->photoshootRepository = $photoshootRepository;
    }

    public function getHomePhotoshoots(int $count)
    {
        $mainPhotoshoots = $this->photoshootRepository->FindNumberOfPhotoshoots($count);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($mainPhotoshoots as $item){
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }
        return $collection;
    }


    public function getAllPhotoshoots()
    {
        $photoshoots = $this->photoshootRepository->FindPhotoshootsWithImages();
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($photoshoots as $item){
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }
        return $collection;
    }
}