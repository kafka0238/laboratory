<?php

namespace App\Controller;

use App\Entity\StorageMethod;
use App\Form\StorageMethodType;
use App\Repository\StorageMethodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StorageMethodController extends AbstractController
{
    /**
     * @Route("/storage-method", name="storage-method")
     * @param StorageMethodRepository $storageMethodRepository
     * @return Response
     */
    public function index(StorageMethodRepository $storageMethodRepository)
    {
        $storageMethods = $storageMethodRepository->findAll();

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('storage_method/index.html.twig', [
            'storageMethods' => $storageMethods,
            'is_show' => $isShow,
        ]);
    }



    /**
     * @Route("/storage-method/create", name="storage-method-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $storageMethod = new StorageMethod();
        $form = $this->createForm(StorageMethodType::class, $storageMethod);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($storageMethod);
            $entityManager->flush();
            return $this->redirectToRoute('storage-method');
        }

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('storage_method/create.html.twig', [
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }

    /**
     * @Route("/storage-method/view/{id}", name="storage-method-view")
     * @param $id
     * @param Request $request
     * @param StorageMethodRepository $storageMethodRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, StorageMethodRepository $storageMethodRepository)
    {
        $storageMethod = $storageMethodRepository
            ->find($id);
        $form = $this->createForm(StorageMethodType::class, $storageMethod);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('storage-method');
        }

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('storage_method/view.html.twig', [
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }
}
