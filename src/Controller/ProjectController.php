<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\InclusionCriterionRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{


    /**
     * @Route("/order/{id_order}/project/create", name="project-create")
     * @param $id_order
     * @param Request $request
     * @param InclusionCriterionRepository $inclusionCriterionRepository
     * @return RedirectResponse|Response
     */
    public function create($id_order, Request $request, InclusionCriterionRepository $inclusionCriterionRepository)
    {
        $project = new Project();
        $project->setIdOrder($id_order);
        $inclusionCriterions = $inclusionCriterionRepository->findAll();
        if($project->getIdInclusionCriterion()) {
            usort($inclusionCriterions, function ($a, $b) use ($project) {
                return $a->getId() != $project->getIdInclusionCriterion();
            });
        }
        $project->setInclusionCriterion($inclusionCriterions);
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
            return $this->redirectToRoute('order-view', ['id'=>$id_order]);
        }

        return $this->render('project/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/order/{id_order}/project/view/{id}", name="project-view")
     * @param $id_order
     * @param $id
     * @param Request $request
     * @param ProjectRepository $projectRepository
     * @param InclusionCriterionRepository $inclusionCriterionRepository
     * @return RedirectResponse|Response
     */
    public function view($id_order, $id, Request $request, ProjectRepository $projectRepository, InclusionCriterionRepository $inclusionCriterionRepository)
    {
        $project = $projectRepository->find($id);
        $inclusionCriterions = $inclusionCriterionRepository->findAll();
        if($project->getIdInclusionCriterion()) {
            usort($inclusionCriterions, function ($a, $b) use ($project) {
                return $a->getId() != $project->getIdInclusionCriterion();
            });
        }
        $project->setInclusionCriterion($inclusionCriterions);
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('order-view', ['id'=>$id_order]);
        }

        return $this->render('project/view.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
