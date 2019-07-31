<?php


namespace App\Service\AdminService;


interface AdminPanelDeleteServiceInterface
{
    public function deletePhotoshoot(int $id);
    public function deleteImage(int $id);
    public function deleteCategory(string $slug);
}