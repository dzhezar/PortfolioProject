<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Controller\Admin;

use App\DTO\AddCategoryForm as AddCategoryFormDto;
use App\DTO\AddPhotoForm as AddPhotoFormDto;
use App\DTO\AddPhotoshootForm as AddPhotoshootFormDto;
use App\Form\AddCategoryForm;
use App\Form\AddPhotoForm;
use App\Form\AddPhotoshootForm;
use App\Form\EditIndexInfoForm;
use App\Form\EditPhotoshootForm;
use App\Service\AdminService\AdminPanelAddServiceInterface;
use App\Service\AdminService\AdminPanelDeleteServiceInterface;
use App\Service\AdminService\AdminPanelEditServiceInderface;
use App\Service\AdminService\AdminPanelServiceInterface;
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
        $form = $this->createForm(AddCategoryForm::class,$formDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addService->addCategory($formDto);
        }

        return $this->render('admin/addCategory.html.twig',
            ['form' => $form->createView()]);
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

            return $this->redirectToRoute('admin');
        }

        return $this->render(
            'admin/addPhotoshoot.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function adminMuaPortfolio(Request $request, PaginatorInterface $paginator)
    {
        $photoshoots = $this->service->getMuaPhotoshoots();
        $category = 'Make-up';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 11);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('admin/admin.html.twig', [
            'pagination' => $pagination,
            'category' => $category
        ]);
    }

    public function adminSneakPeakPortfolio(Request $request, PaginatorInterface $paginator)
    {
        $photoshoots = $this->service->getPhotoshoots();
        $category = 'Sneak peak';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 11);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('admin/admin.html.twig', [
            'pagination' => $pagination,
            'category' => $category
        ]);
    }

    public function adminStylePortfolio(Request $request, PaginatorInterface $paginator)
    {
        $photoshoots = $this->service->getPhotoshoots();
        $category = 'Style';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 11);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('admin/admin.html.twig', [
            'pagination' => $pagination,
            'category' => $category
        ]);
    }

    public function deleteImage($id)
    {
        $photoshoot = $this->deleteService->deleteImage($id);
        return $this->redirectToRoute('editPhotoshootImages',
            ['id' =>$photoshoot]);
    }

    public function deletePhotoshoot($id)
    {
        $this->deleteService->deletePhotoshoot($id);
        return $this->redirectToRoute('admin');
    }

    public function editIndexInfo(Request $request)
    {
        $indexInfo = $this->service->getIndexInfo();
        $indexImg= $this->service->getIndexImg();
        $form = $this->createForm(EditIndexInfoForm::class,$indexInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->editService->editIndexInfo($indexInfo);
            return $this->redirectToRoute('editIndexInfo');
        }

        return $this->render('admin/editIndexInfo.html.twig', [
            'form' => $form->createView(),
            'info' => $indexInfo,
            'img' => $indexImg]);

    }

    public function editPhotoshoot($id, Request $request)
    {
        $photoshoot = $this->service->getPhotoshootById($id);
        $form = $this->createForm(EditPhotoshootForm::class,$photoshoot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->editService->editPhotoshoot($id, $photoshoot);
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/editPhotoshoot.html.twig',
            ['form' => $form->createView()]);

    }

    public function editPhotoshootImages($id, Request $request)
    {
        $images = $this->editService->editPhotoshootImages($id);
        $formDto = new AddPhotoFormDto();
        $form = $this->createForm(AddPhotoForm::class,$formDto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->addService->addImage($formDto, $id);
            $images = $this->editService->editPhotoshootImages($id);
        }

        return $this->render('admin/editPhotos.html.twig',
            ['images' => $images, 'photoshootId' => $id ,'form' => $form->createView()]);
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
        $category = 'All Photoshoots';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 10);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('admin/admin.html.twig', [
            'pagination' => $pagination,
            'category' => $category
        ]);
    }
}
