<?php


namespace App\PhotoshootImage;


use App\DTO\PhotoshootImage;

class PhotoshootImageCollection implements \IteratorAggregate
{
    private $images;

    public function __construct(PhotoshootImage ...$image)
    {
        $this->images = $image;
    }

    public function addPhotoshot(PhotoshootImage $image)
    {
        $this->images[] = $image;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->images);
    }

    public function shift(): PhotoshootImage
    {
        return \array_shift($this->images);
    }

    public function getPhotoshots(): array
    {
        return $this->images;
    }
}