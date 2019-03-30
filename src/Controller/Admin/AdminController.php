<?php


namespace App\Controller\Admin;


use App\DTO\AddPhotoshootForm as AddPhotoshootFormDto;
use App\Form\AddPhotoshootForm;
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

    public function addPhotoshoot(Request $request): Response
    {
        $formDto = new AddPhotoshootFormDto();
        $form = $this->createForm(AddPhotoshootForm::class,$formDto);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $id= $this->service->addPhotoshoot($formDto);
            foreach ($formDto->getImages() as $image) {
                $this->service->addImages($image, $id);
            }
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/addPhotoshoot.html.twig',
            ['form' => $form->createView()]);

    }

    public function deletePhotoshoot($id)
    {
        return new Response('delete');
    }

    public function editPhotoshoot($id, Request $request)
    {
        return new Response('edit');
    }

    public function setIsPosted(Request $request)
    {
        $is_posted = $request->get('is_posted');
        $id = $request->get('id');
        $this->service->setIsPosted($id,$is_posted);
        return new Response('');
    }
    public function showAdminPanel(Request $request, PaginatorInterface $paginator)
    {
        $photoshoots = $this->service->getPhotoshoots();
        $pagination = $paginator->paginate($photoshoots->getPhotoshoots(),$request->query->getInt('page',1),11);
        $pagination->setCustomParameters([
            'rounded' => true,
        ]);
        return $this->render('admin/admin.html.twig',[
            'pagination' => $pagination
        ]);
    }
}