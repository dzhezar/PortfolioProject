<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\DTO;

class PhotoshootImage
{
    private $photoshoot;
    private $image;
    private $queue;

    public function __construct(string $image, int $queue,Photoshoot $photoshoot = null)
    {
        $this->photoshoot = $photoshoot;
        $this->image = $image;
        $this->queue = $queue;
    }

    public function getPhotoshoot(): Photoshoot
    {
        return $this->photoshoot;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getQueue(): int
    {
        return $this->queue;
    }
}
