<?php


namespace App\Service\AdminService;


use App\DTO\EditCategoryForm;
use App\DTO\EditIndexInfoForm;
use App\DTO\EditPhotoshootForm;
use App\Entity\Category;
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
            ->setBackstage($form->isBackstage());
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
            $filename1 = sha1(uniqid()) . '.' . $form->getMainImg1()->guessExtension();
            $form->getMainImg1()->move($this->getTargetDirectory(), $filename1);
            if (file_exists($this->getTargetDirectory().'/'.$indexInfo->getMainImage1())){
                unlink($this->getTargetDirectory().'/'.$indexInfo->getMainImage1());
            }
            $indexInfo->setMainImage1($filename1);
        }
        if ($form->getMainImg2() != null) {
            $filename2 = sha1(uniqid()) . '.' . $form->getMainImg2()->guessExtension();
            $form->getMainImg2()->move($this->getTargetDirectory(), $filename2);
            if (file_exists($this->getTargetDirectory().'/'.$indexInfo->getMainImage2())) {
                unlink($this->getTargetDirectory() . '/' . $indexInfo->getMainImage2());
            }
            $indexInfo->setMainImage2($filename2);
        }
        if ($form->getMainImg3() != null) {
            $filename3 = sha1(uniqid()) . '.' . $form->getMainImg3()->guessExtension();
            $form->getMainImg3()->move($this->getTargetDirectory(), $filename3);
            if (file_exists($this->getTargetDirectory().'/'.$indexInfo->getMainImage3())) {
                unlink($this->getTargetDirectory() . '/' . $indexInfo->getMainImage3());
            }
            $indexInfo->setMainImage3($filename3);
        }
        $indexInfo
            ->setAboutMe($form->getAboutMe());

        $this->em->persist($indexInfo);
        $this->em->flush();
    }

    public function editCategory(string $slug, EditCategoryForm $form)
    {
        $category = $this->em->getRepository(Category::class)->findOneBy(['slug' => $slug]);
        $category->setName($form->getName())
                 ->setIsVisible($form->IsVisible());
        $this->em->persist($category);
        $this->em->flush();
    }
}