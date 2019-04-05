<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Repository\Photoshoot;

interface PhotoshootRepositoryInterface
{
    public function findNumberOfPhotoshoots(int $count, array $category, array $isPosted);
    public function findPostedPhotoshoots();
    public function findAllPhotoshoots();
}
