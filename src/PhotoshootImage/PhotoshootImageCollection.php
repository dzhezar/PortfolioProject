<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

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

    public function shiftU(): ?PhotoshootImage
    {
        $image = \array_shift($this->images);
        \array_unshift($this->images, $image);

        return $image;
    }

    public function shift()
    {
        return \array_shift($this->images);
    }

    public function getPhotoshots(): array
    {
        return $this->images;
    }
}
