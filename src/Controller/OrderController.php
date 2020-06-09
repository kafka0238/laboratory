<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\ProjectRepository;
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
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findAll();
        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }

        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders,
            'is_show' => $isShow,
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
        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }

        return $this->render('order/create.html.twig', [
            'controller_name' => 'OrderController',
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }

    /**
     * @Route("/order/view/{id}", name="order-view")
     * @param $id
     * @param Request $request
     * @param OrderRepository $orderRepository
     * @param ProjectRepository $projectRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, OrderRepository $orderRepository, ProjectRepository $projectRepository)
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
        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }

        $projects = $projectRepository->findBy(['id_order' => $order->getId()]);

        return $this->render('order/view.html.twig', [
            'id_order' => $id,
            'projects' => $projects,
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }
}
