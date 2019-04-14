<?php

/*
 * This file is part of the "Stylish Portfolio" project.
 * (c) Dzhezar Kadyrov <dzhezik@gmail.com>
 */

namespace App\Controller;

use App\DTO\ContactForm as ContactFormDto;
use App\Form\ContactForm;
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
        $mainPageInfo = $service->getMainPageInfo();
        $sneakPeaks = $service->getSneakPeaks(5);
        $formDto = new ContactFormDto();
        $form = $this->createForm(ContactForm::class, $formDto);
        $form->handleRequest($request);

        return $this->render('index.html.twig', [
            'info' => $mainPageInfo,
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

        $mailerService->mail($name,$email,$text);
        return new Response();
    }

    public function showPortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator): Response
    {
        $photoshoots = $service->getPhotoshoots();
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 12);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('portfolio.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    public function showSneakPeakPortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator)
    {
        $photoshoots = $service->getSneakPeaks();
        $category = 'Sneak Peak';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 9);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('portfolio.html.twig', [
            'pagination' => $pagination,
            'category' => $category,
        ]);
    }

    public function showStylePortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator): Response
    {
        $photoshoots = $service->getStylePhotoshoots();
        $category = 'Style';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 9);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('portfolio.html.twig', [
            'pagination' => $pagination,
            'category' => $category,
        ]);
    }

    public function showMuaPortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator): Response
    {
        $photoshoots = $service->getMuaPhotoshoots();
        $category = 'Make-up';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(), $request->query->getInt('page', 1), 9);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);

        return $this->render('portfolio.html.twig', [
            'pagination' => $pagination,
            'category' => $category,
        ]);
    }
}
