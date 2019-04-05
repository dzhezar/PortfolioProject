<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\AdminService;

use App\DTO\AddCategoryForm;
use App\DTO\AddPhotoForm;
use App\DTO\AddPhotoshootForm;
use App\DTO\EditPhotoshootForm;
use App\Entity\Category;
use App\Entity\Photoshoot;
use App\Entity\PhotoshootImage;
use App\Photoshot\PhotoshootCollection;
use App\Photoshot\PhotoshootMapper;
use App\Repository\Photoshoot\PhotoshootRepository;
use App\Repository\PhotoshootImage\PhotoshootImageRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminPanelService implements AdminPanelServiceInterface
{
    private $photoshootRepository;
    private $imageRepository;
    private $em;
    private $targetDirectory;

    public function __construct(PhotoshootRepository $photoshootRepository, PhotoshootImageRepository $imageRepository, EntityManagerInterface $em, $targetDirectory)
    {
        $this->photoshootRepository = $photoshootRepository;
        $this->imageRepository = $imageRepository;
        $this->em = $em;
        $this->targetDirectory = $targetDirectory;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    public function getPhotoshoots(): PhotoshootCollection
    {
        $photoshoots = $this->photoshootRepository->findAllPhotoshoots();
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($photoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function addPhotoshoot(AddPhotoshootForm $form): Photoshoot
    {
        $photoshoot = new Photoshoot();
        $photoshoot
            ->setTitle($form->getTitle())
            ->setCategory($form->getCategory())
            ->setShortDescription($form->getShortDescription())
            ->setDescription($form->getDescription())
            ->setPhotographer($form->getPhotographer())
            ->setModel($form->getModel())
            ->setIsPosted(false)
            ->setPublicationDate(new DateTime());
        $this->em->persist($photoshoot);
        $this->em->flush();

        return $photoshoot;
    }

    public function addImages(UploadedFile $image, Photoshoot $photoshoot)
    {
        $filename = \sha1(\uniqid()) . '.' . $image->guessExtension();

        $image->move($this->getTargetDirectory() . '/' . $photoshoot->getId(), $filename);

        $photoshootImage = new PhotoshootImage();
        $photoshootImage
            ->setPhotoshoot($photoshoot)
            ->setImage($filename);
        $this->em->persist($photoshootImage);
        $this->em->flush();
    }

    public function setIsPosted(int $id, int $val)
    {
        $photoshoot = $this->photoshootRepository->findOneBy(['id' => $id]);

        $photoshoot->setIsPosted($val);
        $this->em->persist($photoshoot);
        $this->em->flush();
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

    public function deletePhotoshoot(int $id)
    {
        $photoshoot = $this->photoshootRepository->findOneBy(['id' => $id]);
        $images = $this->imageRepository->findBy(['Photoshoot' => $photoshoot]);

        foreach ($images as $image) {
            \unlink($this->getTargetDirectory() . '/' . $photoshoot->getId().'/'.$image->getImage());
            $this->em->remove($image);
        }
        $this->em->flush();
        rmdir($this->getTargetDirectory() . '/' . $photoshoot->getId());
        $this->em->remove($photoshoot);
        $this->em->flush();
    }

    public function getPhotoshootById(int $id)
    {
        $photoshoot = $this->photoshootRepository->findOneBy(['id' => $id]);
        $mapper = new PhotoshootMapper();
        return $mapper->entityToEditFormDto($photoshoot);

    }

    public function editPhotoshootImages(int $id)
    {
        return $this->imageRepository->findBy(['Photoshoot' => $id]);

    }

    public function deleteImage(int $id)
    {
        $image = $this->imageRepository->findOneBy(['id' => $id]);
        \unlink($this->getTargetDirectory() . '/' . $image->getPhotoshoot()->getId().'/'.$image->getImage());
        $this->em->remove($image);
        $this->em->flush();
        return $image->getPhotoshoot()->getId();
    }

    public function addImage(AddPhotoForm $form, int $id)
    {
        $photoshoot = $this->photoshootRepository->findOneBy(['id' => $id]);
        $images = $form->getImages();

        foreach ($images as $image){
            $filename = \sha1(\uniqid()) . '.' . $image->guessExtension();

            $image->move($this->getTargetDirectory() . '/' . $id, $filename);

            $photoshootImage = new PhotoshootImage();
            $photoshootImage
                ->setPhotoshoot($photoshoot)
                ->setImage($filename);
            $this->em->persist($photoshootImage);
            $this->em->flush();
        }
    }

    public function addCategory(AddCategoryForm $form)
    {
        $category = new Category();
        $category
            ->setName($form->getName());

        $this->em->persist($category);
        $this->em->flush();
    }

    public function getMuaPhotoshoots(int $count = null): PhotoshootCollection
    {
        $muaPhotoshoots = $this->photoshootRepository->findNumberOfPhotoshoots($count,['Make-up'],[0,1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($muaPhotoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function getStylePhotoshoots(int $count = null): PhotoshootCollection
    {
        $stylePhotoshoots = $this->photoshootRepository->findNumberOfPhotoshoots($count,['Style'],[0,1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($stylePhotoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }

    public function getSneakPeakPhotoshoots(int $count = null): PhotoshootCollection
    {
        $sneakPeakPhotoshoots = $this->photoshootRepository->findNumberOfPhotoshoots($count,['Sneak peak'],[0,1]);
        $photoshootMapper = new PhotoshootMapper();
        $collection = new PhotoshootCollection();

        foreach ($sneakPeakPhotoshoots as $item) {
            $collection->addPhotoshoot($photoshootMapper->entityToDto($item));
        }

        return $collection;
    }
}
