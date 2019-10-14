<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\HomePage;

interface HomePageServiceInterface
{
    public function getPhotoshoots(int $count = null);
    public function getSneakPeaks(int $count = null);
    public function getPhotoshootsByCategory(string $slug, int $count = null);
    public function getMainPageInfo();
    public function getIndexImg();
}
