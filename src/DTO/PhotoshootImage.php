<?php


namespace App\DTO;


class PhotoshootImage
{
    private $photoshoot;
    private $image;

    public function __construct(string $image, Photoshoot $photoshoot = null)
    {
        $this->photoshoot = $photoshoot;
        $this->image = $image;
    }

    public function getPhotoshoot(): Photoshoot
    {
        return $this->photoshoot;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}