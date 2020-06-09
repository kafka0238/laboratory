<?php

namespace App\Controller;

use App\Entity\Thing;
use App\Form\ThingType;
use App\Repository\LaboratoryRepository;
use App\Repository\ProjectRepository;
use App\Repository\SetSampleRepository;
use App\Repository\ThingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThingController extends AbstractController
{
    /**
     * @Route("/thing", name="thing")
     * @param ThingRepository $thingRepository
     * @return Response
     */
    public function index(ThingRepository $thingRepository)
    {
        $things = $thingRepository->findAll();

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('thing/index.html.twig', [
            'things' => $things,
            'is_show' => $isShow,
        ]);
    }

    /**
     * @Route("/thing/create", name="thing-create")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create(Request $request, ProjectRepository $projectRepository, LaboratoryRepository $laboratoryRepository)
    {
        $thing = new Thing();

        $projects = $projectRepository->findAll();
        if($thing->getIdProject()) {
            usort($projects, function ($a, $b) use ($thing) {
                return $a->getId() != $thing->getIdProject();
            });
        }
        $thing->setProjects($projects);
        $laboratories = $laboratoryRepository->findAll();
        if($thing->getIdLaboratory()) {
            usort($laboratories, function ($a, $b) use ($thing) {
                return $a->getId() != $thing->getIdLaboratory();
            });
        }
        $thing->setLaboratories($laboratories);

        $form = $this->createForm(ThingType::class, $thing);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($thing);
            $entityManager->flush();
            return $this->redirectToRoute('thing');
        }

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('thing/create.html.twig', [
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }

    /**
     * @Route("/thing/view/{id}", name="thing-view")
     * @param $id
     * @param Request $request
     * @param ThingRepository $thingRepository
     * @param SetSampleRepository $setSampleRepository
     * @param ProjectRepository $projectRepository
     * @param LaboratoryRepository $laboratoryRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, ThingRepository $thingRepository, SetSampleRepository $setSampleRepository, ProjectRepository $projectRepository, LaboratoryRepository $laboratoryRepository)
    {
        $thing = $thingRepository->find($id);

        $projects = $projectRepository->findAll();
        if($thing->getIdProject()) {
            usort($projects, function ($a, $b) use ($thing) {
                return $a->getId() != $thing->getIdProject();
            });
        }
        $thing->setProjects($projects);
        $laboratories = $laboratoryRepository->findAll();
        if($thing->getIdLaboratory()) {
            usort($laboratories, function ($a, $b) use ($thing) {
                return $a->getId() != $thing->getIdLaboratory();
            });
        }
        $thing->setLaboratories($laboratories);

        $form = $this->createForm(ThingType::class, $thing);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('thing');
        }

        $setSamples = $setSampleRepository->findBy(['id_thing' => $thing->getId()]);

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('thing/view.html.twig', [
            'id_thing' => $id,
            'set_samples' => $setSamples,
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }
}
