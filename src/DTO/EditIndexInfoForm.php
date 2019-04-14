<?php


namespace App\DTO;


class EditIndexInfoForm
{
    private $main_img1;
    private $main_img2;
    private $main_img3;
    private $aboutLina;
    private $aboutKatya;


    public function __construct(string $aboutLina, string $aboutKatya,$main_img1 = null, $main_img2 = null, $main_img3 = null)
    {
        $this->main_img1 = $main_img1;
        $this->main_img2 = $main_img2;
        $this->main_img3 = $main_img3;
        $this->aboutLina = $aboutLina;
        $this->aboutKatya = $aboutKatya;
    }


    public function getMainImg1()
    {
        return $this->main_img1;
    }


    public function setMainImg1($main_img1): void
    {
        $this->main_img1 = $main_img1;
    }

     function getMainImg2()
    {
        return $this->main_img2;
    }


    public function setMainImg2($main_img2): void
    {
        $this->main_img2 = $main_img2;
    }


    public function getMainImg3()
    {
        return $this->main_img3;
    }


    public function setMainImg3($main_img3): void
    {
        $this->main_img3 = $main_img3;
    }


    public function getAboutLina(): ?string
    {
        return $this->aboutLina;
    }


    public function setAboutLina(string $aboutLina): void
    {
        $this->aboutLina = $aboutLina;
    }


    public function getAboutKatya(): ?string
    {
        return $this->aboutKatya;
    }


    public function setAboutKatya(string $aboutKatya): void
    {
        $this->aboutKatya = $aboutKatya;
    }



}