<?php


namespace App\Service\AdminService;


use App\DTO\EditIndexInfoForm;
use App\DTO\EditPhotoshootForm;
use App\Repository\MainPageRepository;
use App\Repository\Photoshoot\PhotoshootRepository;
use App\Repository\PhotoshootImage\PhotoshootImageRepository;
use Doctrine\ORM\EntityManagerInterface;

class AdminPanelEditService implements AdminPanelEditServiceInderface
{

    private $photoshootRepository;
    private $imageRepository;
    private $em;
    private $indexRepository;
    private $targetDirectory;

    public function __construct(PhotoshootRepository $photoshootRepository, PhotoshootImageRepository $imageRepository, EntityManagerInterface $em, MainPageRepository $indexRepository, $targetDirectory)
    {
        $this->photoshootRepository = $photoshootRepository;
        $this->imageRepository = $imageRepository;
        $this->em = $em;
        $this->indexRepository = $indexRepository;
        $this->targetDirectory = $targetDirectory;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    public function editPhotoshoot(int $id, EditPhotoshootForm $form)
    {
        $photoshoot = $this->photoshootRepository->findOneBy(['id' => $id]);
        $photoshoot
            ->setTitle($form->getTitle())
            ->setCategory($form->getCategory())
            ->setShortDescription($form->getShortDescription())
            ->setDescription($form->getDescription())
            ->setPhotographer($form->getPhotographer())
            ->setModel($form->getModel());
        $this->em->persist($photoshoot);
        $this->em->flush();
    }

    public function editPhotoshootImages(int $id)
    {
        return $this->imageRepository->findBy(['Photoshoot' => $id]);
    }

    public function editIndexInfo(EditIndexInfoForm $form)
    {
        $indexInfo = $this->indexRepository->findOneBy([]);
        if ($form->getMainImg1() != null) {
            $filename1 = \sha1(\uniqid()) . '.' . $form->getMainImg1()->guessExtension();
            unlink($this->getTargetDirectory().'/'.$indexInfo->getMainImage1());
            $form->getMainImg1()->move($this->getTargetDirectory(), $filename1);
            $indexInfo->setMainImage1($filename1);
        }
        if ($form->getMainImg2() != null) {
            $filename2 = \sha1(\uniqid()) . '.' . $form->getMainImg2()->guessExtension();
            unlink($this->getTargetDirectory().'/'.$indexInfo->getMainImage2());
            $form->getMainImg2()->move($this->getTargetDirectory(), $filename2);
            $indexInfo->setMainImage2($filename2);
        }
        if ($form->getMainImg3() != null) {
            $filename3 = \sha1(\uniqid()) . '.' . $form->getMainImg3()->guessExtension();
            unlink($this->getTargetDirectory().'/'.$indexInfo->getMainImage3());
            $form->getMainImg3()->move($this->getTargetDirectory(), $filename3);
            $indexInfo->setMainImage3($filename3);
        }
        $indexInfo
            ->setAboutLina($form->getAboutLina())
            ->setAboutKatya($form->getAboutKatya());

        $this->em->persist($indexInfo);
        $this->em->flush();
    }
}