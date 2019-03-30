<?php


namespace App\Service\HomePage;


interface HomePageServiceInterface
{
    public function getHomePhotoshoots(int $count);
    public function getAllPhotoshoots();
    public function getStylePhotoshoots();
    public function getMuaPhotoshoots();
}