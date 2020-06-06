<?php

namespace App\Controller;

use App\Entity\Container;
use App\Form\ContainerType;
use App\Repository\ContainerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="container")
     * @param ContainerRepository $containerRepository
     * @return Response
     */
    public function index(ContainerRepository $containerRepository)
    {
        $containers = $containerRepository->findAll();

        return $this->render('container/index.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $containers,
        ]);
    }



    /**
     * @Route("/order/create", name="container-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $order = new Container();
        $form = $this->createForm(ContainerType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute('container');
        }

        return $this->render('container/create.html.twig', [
            'controller_name' => 'OrderController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/container/view/{id}", name="container-view")
     * @param $id
     * @param Request $request
     * @param ContainerRepository $containerRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, ContainerRepository $containerRepository)
    {
        $container = $containerRepository
            ->find($id);
        $form = $this->createForm(ContainerType::class, $container);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('container');
        }

        return $this->render('container/view.html.twig', [
            'controller_name' => 'OrderController',
            'form' => $form->createView(),
        ]);
    }
}
