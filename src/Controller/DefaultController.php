<?php


namespace App\Controller;


use App\Service\HomePage\HomePageServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(HomePageServiceInterface $service) :Response
    {
        $mainPhotoshoots = $service->getHomePhotoshoots(4);
        //dd($mainPhotoshoots);
        return $this->render('index.html.twig',[
            'mainPhotoshoots' => $mainPhotoshoots
        ]);
    }

    public function showPortfolio(Request $request, HomePageServiceInterface $service, PaginatorInterface $paginator): Response
    {
        $photoshoots = $service->getAllPhotoshoots();
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(),$request->query->getInt('page',1),8);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);
        return $this->render('portfolio.html.twig',[
            'pagination' => $pagination
        ]);
    }
}