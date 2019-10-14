<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Controller\Admin;

use App\Category\CategoryMapper;
use App\DTO\AddCategoryForm as AddCategoryFormDto;
use App\DTO\AddPhotoForm as AddPhotoFormDto;
use App\DTO\AddPhotoshootForm as AddPhotoshootFormDto;
use App\Entity\Category;
use App\Form\AddCategoryForm;
use App\Form\AddPhotoForm;
use App\Form\AddPhotoshootForm;
use App\Form\EditCategoryForm;
use App\Form\EditIndexInfoForm;
use App\Form\EditPhotoshootForm;
use App\Repository\Category\CategoryRepository;
use App\Repository\Photoshoot\PhotoshootRepository;
use App\Service\AdminService\AdminPanelAddServiceInterface;
use App\Service\AdminService\AdminPanelDeleteServiceInterface;
use App\Service\AdminService\AdminPanelEditServiceInderface;
use App\Service\AdminService\AdminPanelServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    private $service;
    private $addService;
    private $deleteService;
    private $editService;

    public function __construct(AdminPanelServiceInterface $service, AdminPanelAddServiceInterface $addService, AdminPanelDeleteServiceInterface $deleteService, AdminPanelEditServiceInderface $editService)
    {
        $this->service = $service;
        $this->addService = $addService;
        $this->deleteService = $deleteService;
        $this->editService = $editService;
    }

    public function addCategory(Request $request)
    {
        $formDto = new AddCategoryFormDto();
        $form = $this->createForm(AddCategoryForm::class, $formDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addService->addCategory($formDto);

            return $this->redirectToRoute('admin');
        }

        return $this->render(
            'admin/addCategory.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function addPhotoshoot(Request $request): Response
    {
        $formDto = new AddPhotoshootFormDto();
        $form = $this->createForm(AddPhotoshootForm::class, $formDto);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $id= $this->addService->addPhotoshoot($formDto);

            foreach ($formDto->getImages() as $image) {
                $this->addService->addImages($image, $id);
            }

            return $this->redirectToRoute('adminPortfolioCategory', ['slug' => $formDto->getCategory()->getSlug()]);
        }

        return $this->render(
            'admin/addPhotoshoot.html.twig',
            ['form' => $form->createView()]
        );
    }


    public function adminPortfolioCategory(string $slug, Request $request, PaginatorInterface $paginator, EntityManagerInterface $manager)
    {
        $photoshoots = $this->service->getPhotoshootsByCategory($slug);
        $categoryName = $manager->getRepository(Category::class)->findOneBy(['slug' => $slug]);
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 11);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('admin/admin.html.twig', [
            'pagination' => $pagination,
            'categoryName' => $categoryName,
        ]);
    }

    public function deleteImage($id)
    {
        $photoshoot = $this->deleteService->deleteImage($id);

        return $this->redirectToRoute(
            'editPhotoshootImages',
            ['id' =>$photoshoot]
        );
    }

    public function deletePhotoshoot($id, PhotoshootRepository $photoshootRepository)
    {
        $photoshoot = $photoshootRepository->findOneBy(['id' => $id]);
        $category = $photoshoot->getCategory()->getSlug();
        $this->deleteService->deletePhotoshoot($id);

        if ($category) {
            return $this->redirectToRoute('adminPortfolioCategory', ['slug' => $category]);
        }
        
        return $this->redirectToRoute('admin');
    }

    public function editCategory(string $slug, Request $request, CategoryRepository $repository, CategoryMapper $mapper)
    {
        $category = $mapper->entityToFormDto($repository->findOneBy(['slug' => $slug]));
        $form = $this->createForm(EditCategoryForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->editService->editCategory($slug, $category);
            $this->redirectToRoute('adminPortfolioCategory', ['slug' => $slug]);
        }

        return $this->render('admin/editCategory.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function editIndexInfo(Request $request)
    {
        $indexInfo = $this->service->getIndexInfo();
        $indexImg= $this->service->getIndexImg();
        $form = $this->createForm(EditIndexInfoForm::class, $indexInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->editService->editIndexInfo($indexInfo);

            return $this->redirectToRoute('editIndexInfo');
        }

        return $this->render('admin/editIndexInfo.html.twig', [
            'form' => $form->createView(),
            'info' => $indexInfo,
            'img' => $indexImg, ]);
    }

    public function editPhotoshoot($id, Request $request)
    {
        $photoshoot = $this->service->getPhotoshootById($id);
        $form = $this->createForm(EditPhotoshootForm::class, $photoshoot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->editService->editPhotoshoot($id, $photoshoot);

            return $this->redirectToRoute('adminPortfolioCategory', ['slug' => $photoshoot->getCategory()->getSlug()]);
        }

        return $this->render(
            'admin/editPhotoshoot.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function editPhotoshootImages($id, Request $request)
    {
        $images = $this->editService->editPhotoshootImages($id);
        $formDto = new AddPhotoFormDto();
        $form = $this->createForm(AddPhotoForm::class, $formDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addService->addImage($formDto, $id);
            $this->editService->editPhotoshootImages($id);

            return $this->redirectToRoute('editPhotoshootImages', ['id' => $id]);
        }

        return $this->render(
            'admin/editPhotos.html.twig',
            ['images' => $images, 'photoshootId' => $id,'form' => $form->createView()]
        );
    }

    public function setIsPosted(Request $request)
    {
        $is_posted = $request->get('is_posted');
        $id = $request->get('id');
        $this->service->setIsPosted($id, $is_posted);

        return new Response('');
    }
    public function showAdminPanel(Request $request, PaginatorInterface $paginator)
    {
        $photoshoots = $this->service->getPhotoshoots();
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 10);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('admin/admin.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    public function categoryMenu(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin/categoryMenu.html.twig', ['categories' => $categories]);
    }

    public function deleteCategory($slug, CategoryRepository $categoryRepository, PhotoshootRepository $photoshootRepository)
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
        $photoshoots = $photoshootRepository->findBy(['Category' => $category]);

        foreach ($photoshoots as $photoshoot) {
            $this->deleteService->deletePhotoshoot($photoshoot->getId());
        }
        $this->deleteService->deleteCategory($slug);

        return $this->redirectToRoute('admin');
    }
}
