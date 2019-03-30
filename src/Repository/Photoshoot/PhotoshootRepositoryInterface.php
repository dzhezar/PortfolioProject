<?php


namespace App\Repository\Photoshoot;


interface PhotoshootRepositoryInterface
{
    public function findNumberOfPhotoshoots(int $count);
    public function findPostedPhotoshoots();
    public function findAllPhotoshoots();
    public function findPhotoshootsByCategory(string $category);
}