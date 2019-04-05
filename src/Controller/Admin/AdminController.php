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
use App\Form\EditPhotoshootForm;
use App\Service\AdminService\AdminPanelServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    private $service;

    public function __construct(AdminPanelServiceInterface $service)
    {
        $this->service = $service;
    }

    public function addCategory(Request $request)
    {
        $formDto = new AddCategoryFormDto();
        $form = $this->createForm(AddCategoryForm::class,$formDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->addCategory($formDto);
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
            $id= $this->service->addPhotoshoot($formDto);

            foreach ($formDto->getImages() as $image) {
                $this->service->addImages($image, $id);
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
        $photoshoot = $this->service->deleteImage($id);
        return $this->redirectToRoute('editPhotoshootImages',
            ['id' =>$photoshoot]);
    }

    public function deletePhotoshoot($id)
    {
        $this->service->deletePhotoshoot($id);
        return $this->redirectToRoute('admin');
    }

    public function editPhotoshoot($id, Request $request)
    {
        $photoshoot = $this->service->getPhotoshootById($id);
        $form = $this->createForm(EditPhotoshootForm::class,$photoshoot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->service->editPhotoshoot($id, $photoshoot);
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/editPhotoshoot.html.twig',
            ['form' => $form->createView()]);

    }

    public function editPhotoshootImages($id, Request $request)
    {
        $images = $this->service->editPhotoshootImages($id);
        $formDto = new AddPhotoFormDto();
        $form = $this->createForm(AddPhotoForm::class,$formDto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->service->addImage($formDto, $id);
            $images = $this->service->editPhotoshootImages($id);
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
