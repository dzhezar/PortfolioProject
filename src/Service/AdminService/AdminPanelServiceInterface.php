<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\AdminService;

use App\DTO\AddPhotoshootForm;
use App\Entity\Photoshoot;
use App\Photoshot\PhotoshootCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AdminPanelServiceInterface
{
    public function getPhotoshoots(): PhotoshootCollection;
    public function setIsPosted(int $id, int $val);
    public function addPhotoshoot(AddPhotoshootForm $form): Photoshoot;
    public function addImages(UploadedFile $image, Photoshoot $photoshoot);
    public function editPhotoshoot(int $id);
}
