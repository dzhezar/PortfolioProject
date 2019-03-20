<?php

/*
 * This file is part of the "HouseBooking-project" package.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Photoshot;

use App\Dto\Photoshoot;

class PhotoshootCollection implements \IteratorAggregate
{
    private $photoshots;

    public function __construct(Photoshoot ...$photoshots)
    {
        $this->photoshots = $photoshots;
    }

    public function addPhotoshoot(Photoshoot $photoshot)
    {
        $this->photoshots[] = $photoshot;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->photoshots);
    }

    public function shift(): ?Photoshoot
    {
        return \array_shift($this->photoshots);
    }

    public function getPhotoshoots(): array
    {
        return $this->photoshots;
    }
}
