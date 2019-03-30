<?php


namespace App\Controller;


use App\DTO\ContactForm as ContactFormDto;
use App\Form\ContactForm;
use App\Service\HomePage\HomePageServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(HomePageServiceInterface $service, Request $request) :Response
    {
        $mainPhotoshoots = $service->getHomePhotoshoots(4);
        $formDto = new ContactFormDto();
        $form = $this->createForm(ContactForm::class,$formDto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            dd($formDto);
        }

        return $this->render('index.html.twig',[
            'mainPhotoshoots' => $mainPhotoshoots,
            'contactForm' =>$form->createView()
        ]);
    }

    public function showPortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator): Response
    {
        $photoshoots = $service->getAllPhotoshoots();
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(),$request->query->getInt('page',1),9);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);
        return $this->render('portfolio.html.twig',[
            'pagination' => $pagination
        ]);
    }

    public function showStylePortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator): Response
    {
        $photoshoots = $service->getStylePhotoshoots();
        $category = 'Style';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(),$request->query->getInt('page',1),9);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);
        return $this->render('portfolio.html.twig',[
            'pagination' => $pagination,
            'category' => $category
        ]);
    }

    public function showMuaPortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator): Response
    {
        $photoshoots = $service->getStylePhotoshoots();
        $category = 'Make-up';
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(),$request->query->getInt('page',1),9);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);
        return $this->render('portfolio.html.twig',[
            'pagination' => $pagination,
            'category' => $category
        ]);
    }
}