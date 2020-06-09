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

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }

        return $this->render('container/index.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $containers,
            'is_show' => $isShow,
        ]);
    }



    /**
     * @Route("/container/create", name="container-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $order = new Container();
        $form = $this->createForm(ContainerType::class, $order);

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
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
            'is_show' => $isShow,
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

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('container/view.html.twig', [
            'controller_name' => 'OrderController',
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }
}
