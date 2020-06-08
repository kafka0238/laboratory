<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material", name="material")
     * @param MaterialRepository $materialRepository
     * @return Response
     */
    public function index(MaterialRepository $materialRepository)
    {
        $materials = $materialRepository->findAll();

        return $this->render('material/index.html.twig', [
            'materials' => $materials,
        ]);
    }



    /**
     * @Route("/material/create", name="material-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $material = new Material();
        $form = $this->createForm(MaterialType::class, $material);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($material);
            $entityManager->flush();
            return $this->redirectToRoute('material');
        }

        return $this->render('material/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/material/view/{id}", name="material-view")
     * @param $id
     * @param Request $request
     * @param MaterialRepository $materialRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, MaterialRepository $materialRepository)
    {
        $material = $materialRepository
            ->find($id);
        $form = $this->createForm(MaterialType::class, $material);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('material');
        }

        return $this->render('material/view.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
