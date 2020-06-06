<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/", name="order")
     * @param OrderRepository $orderRepository
     * @return Response
     */
    public function index(OrderRepository $orderRepository)
    {
        $orders = [];
        $orders = $orderRepository->findAll();

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/order/create", name="order-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute('order');
        }

        return $this->render('order/create.html.twig', [
            'controller_name' => 'OrderController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/order/view/{id}", name="order-view")
     * @param $id
     * @param Request $request
     * @param OrderRepository $orderRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, OrderRepository $orderRepository)
    {
        $order = $orderRepository
            ->find($id);
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('order');
        }

        return $this->render('order/view.html.twig', [
            'controller_name' => 'OrderController',
            'form' => $form->createView(),
        ]);
    }


}
