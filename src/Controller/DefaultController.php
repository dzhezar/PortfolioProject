<?php


namespace App\Controller;


use App\Service\HomePage\HomePageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(Request $request, HomePageServiceInterface $service) :Response
    {
        $mainPhotoshoots = $service->getHomePhotoshoots(4);
        return $this->render('base.html.twig',[
            'mainPhotoshoots' => $mainPhotoshoots
        ]);
    }
}