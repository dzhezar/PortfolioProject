<?php


namespace App\Service\AdminService;


use App\DTO\EditCategoryForm;
use App\DTO\EditIndexInfoForm;
use App\DTO\EditPhotoshootForm;

interface AdminPanelEditServiceInderface
{
    public function editPhotoshoot(int $id, EditPhotoshootForm $form);
    public function editPhotoshootImages(int $id);
    public function editIndexInfo(EditIndexInfoForm $form);
    public function editCategory(string $slug, EditCategoryForm $form);
}