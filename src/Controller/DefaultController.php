<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Controller;

use App\DTO\ContactForm as ContactFormDto;
use App\Form\ContactForm;
use App\Repository\Category\CategoryRepository;
use App\Service\HomePage\HomePageServiceInterface;
use App\Service\Mailer\MailerServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(HomePageServiceInterface $service, Request $request): Response
    {
        $mainPhotoshoots = $service->getPhotoshoots(4);
//        dd($mainPhotoshoots);
        $aboutMe = $service->getMainPageInfo()->getAboutMe();
        $mainImgs = $service->getIndexImg();
        $firstImg = $mainImgs->getMainImg1();
        $otherImgs = \array_filter([$mainImgs->getMainImg2(),$mainImgs->getMainImg3()]);
        $sneakPeaks = $service->getSneakPeaks(5);
        $formDto = new ContactFormDto();
        $form = $this->createForm(ContactForm::class, $formDto);
        $form->handleRequest($request);

        return $this->render('index.html.twig', [
            'aboutMe' => $aboutMe,
            'firstImg' => $firstImg,
            'otherImages' => $otherImgs,
            'mainPhotoshoots' => $mainPhotoshoots,
            'mainSneakPeaks' => $sneakPeaks,
            'contactForm' =>$form->createView(),
        ]);
    }

    public function sendMail(Request $request, MailerServiceInterface $mailerService)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $text = $request->get('text');

        $mailerService->mail($name, $email, $text);

        return new Response();
    }

    public function showPortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator, CategoryRepository $categoryRepository): Response
    {
        $photoshoots = $service->getPhotoshoots();
        $categories = $categoryRepository->findBy(['is_visible' => 1]);
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 12);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('portfolio.html.twig', [
            'pagination' => $pagination,
            'categories' => $categories,
        ]);
    }


    public function showPortfolioCategory(string $slug, Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator, CategoryRepository $categoryRepository)
    {
        $photoshoots = $service->getPhotoshootsByCategory($slug);
        $categories = $categoryRepository->findBy(['is_visible' => 1]);
        $categoryName = $categoryRepository->findOneBy(['slug' => $slug])->getName();
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 12);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('portfolio.html.twig', [
            'pagination' => $pagination,
            'categoryName' => $categoryName,
            'categories' => $categories,
        ]);
    }

    public function renderHeader(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findBy(['is_visible' => 1]);
        return $this->render('elements/header', [
            'categories' => $categories,
        ]);
    }

    public function renderMobileHeader(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findBy(['is_visible' => 1]);
        return $this->render('elements/mobileHeader', [
            'categories' => $categories,
        ]);
    }
}
