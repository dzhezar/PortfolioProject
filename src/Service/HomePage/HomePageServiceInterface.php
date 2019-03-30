<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\HomePage;

interface HomePageServiceInterface
{
    public function getHomePhotoshoots(int $count);
    public function getAllPhotoshoots();
    public function getStylePhotoshoots();
    public function getMuaPhotoshoots();
}
