<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Service\AdminService;

use App\DTO\AddPhotoshootForm;
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

    public function editPhotoshoot(int $id)
    {
        // TODO: Implement editPhotoshoot() method.
    }
}
