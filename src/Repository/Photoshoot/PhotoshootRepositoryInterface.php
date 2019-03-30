<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Repository\Photoshoot;

interface PhotoshootRepositoryInterface
{
    public function findNumberOfPhotoshoots(int $count);
    public function findPostedPhotoshoots();
    public function findAllPhotoshoots();
    public function findPhotoshootsByCategory(string $category);
}
