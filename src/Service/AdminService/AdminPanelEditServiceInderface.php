<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

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
