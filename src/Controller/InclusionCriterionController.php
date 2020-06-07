<?php

namespace App\Controller;

use App\Entity\InclusionCriterion;
use App\Form\InclusionCriterionType;
use App\Repository\InclusionCriterionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InclusionCriterionController extends AbstractController
{
    /**
     * @Route("/inclusion-criterion", name="inclusion-criterion")
     * @param InclusionCriterionRepository $inclusionCriterionRepository
     * @return Response
     */
    public function index(InclusionCriterionRepository $inclusionCriterionRepository)
    {
        $inclusionCriterions = $inclusionCriterionRepository->findAll();

        return $this->render('inclusion_criterion/index.html.twig', [
            'inclusionCriterions' => $inclusionCriterions,
        ]);
    }



    /**
     * @Route("/inclusion-criterion/create", name="inclusion-criterion-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $inclusionCriterion = new InclusionCriterion();
        $form = $this->createForm(InclusionCriterionType::class, $inclusionCriterion);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inclusionCriterion);
            $entityManager->flush();
            return $this->redirectToRoute('inclusion-criterion');
        }

        return $this->render('inclusion_criterion/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inclusion-criterion/view/{id}", name="inclusion-criterion-view")
     * @param $id
     * @param Request $request
     * @param InclusionCriterionRepository $inclusionCriterionRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, InclusionCriterionRepository $inclusionCriterionRepository)
    {
        $inclusionCriterion = $inclusionCriterionRepository
            ->find($id);
        $form = $this->createForm(InclusionCriterionType::class, $inclusionCriterion);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('inclusion-criterion');
        }

        return $this->render('inclusion_criterion/view.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
