<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\DTO;

class IndexInfo
{
    private $mainImg1;
    private $mainImg2;
    private $mainImg3;

    public function __construct($mainImg1 = null, $mainImg2 = null, $mainImg3 = null)
    {
        $this->mainImg1 = $mainImg1;
        $this->mainImg2 = $mainImg2;
        $this->mainImg3 = $mainImg3;
    }

    public function getMainImg1()
    {
        return $this->mainImg1;
    }

    public function setMainImg1($mainImg1): void
    {
        $this->mainImg1 = $mainImg1;
    }

    public function getMainImg2()
    {
        return $this->mainImg2;
    }

    public function setMainImg2($mainImg2): void
    {
        $this->mainImg2 = $mainImg2;
    }

    public function getMainImg3()
    {
        return $this->mainImg3;
    }

    public function setMainImg3($mainImg3): void
    {
        $this->mainImg3 = $mainImg3;
    }
}
