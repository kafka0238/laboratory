<?php

namespace App\Controller;

use App\Entity\Laboratory;
use App\Form\LaboratoryType;
use App\Repository\LaboratoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LaboratoryController extends AbstractController
{
    /**
     * @Route("/laboratory", name="laboratory")
     * @param LaboratoryRepository $laboratoryRepository
     * @return Response
     */
    public function index(LaboratoryRepository $laboratoryRepository)
    {
        $laboratories = $laboratoryRepository->findAll();

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('laboratory/index.html.twig', [
            'laboratories' => $laboratories,
            'is_show' => $isShow,
        ]);
    }



    /**
     * @Route("/laboratory/create", name="laboratory-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $laboratory = new Laboratory();
        $form = $this->createForm(LaboratoryType::class, $laboratory);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($laboratory);
            $entityManager->flush();
            return $this->redirectToRoute('laboratory');
        }

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('laboratory/create.html.twig', [
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }

    /**
     * @Route("/laboratory/view/{id}", name="laboratory-view")
     * @param $id
     * @param Request $request
     * @param LaboratoryRepository $laboratoryRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, LaboratoryRepository $laboratoryRepository)
    {
        $laboratory = $laboratoryRepository
            ->find($id);
        $form = $this->createForm(LaboratoryType::class, $laboratory);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('laboratory');
        }

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('laboratory/view.html.twig', [
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }
}
