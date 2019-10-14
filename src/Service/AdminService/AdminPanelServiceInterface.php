<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\AdminService;

use App\Photoshot\PhotoshootCollection;

interface AdminPanelServiceInterface
{
    public function getPhotoshoots(): PhotoshootCollection;
    public function getPhotoshootsByCategory(string $slug, int $count = null): PhotoshootCollection;
    public function getPhotoshootById(int $id);
    public function getIndexInfo();
    public function getIndexImg();
    public function setIsPosted(int $id, int $val);
}
