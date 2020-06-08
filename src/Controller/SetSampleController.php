<?php

namespace App\Controller;

use App\Entity\SetSample;
use App\Form\SetSampleType;
use App\Repository\ContainerRepository;
use App\Repository\LaboratoryRepository;
use App\Repository\MaterialRepository;
use App\Repository\SetSampleRepository;
use App\Repository\StorageMethodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SetSampleController extends AbstractController
{
    /**
     * @Route("/thing/{id_thing}/set-sample/create", name="set_sample-create")
     * @param $id_thing
     * @param Request $request
     * @param MaterialRepository $materialRepository
     * @param ContainerRepository $containerRepository
     * @param StorageMethodRepository $storageMethodRepository
     * @param LaboratoryRepository $laboratoryRepository
     * @return RedirectResponse|Response
     */
    public function create($id_thing,
                           Request $request,
                           MaterialRepository $materialRepository,
                           ContainerRepository $containerRepository,
                           StorageMethodRepository $storageMethodRepository,
                           LaboratoryRepository $laboratoryRepository)
    {
        $setSample = new SetSample();
        $setSample->setIdThing($id_thing);
        $setSample->setMaterials($materialRepository->findAll());
        $setSample->setContainers($containerRepository->findAll());
        $setSample->setStorageMethods($storageMethodRepository->findAll());
        $setSample->setLaboratories($laboratoryRepository->findAll());
        $form = $this->createForm(SetSampleType::class, $setSample);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setSample);
            $entityManager->flush();
            return $this->redirectToRoute('thing-view', ['id'=>$id_thing]);
        }

        return $this->render('set_sample/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/thing/{id_thing}/set-sample/view/{id}", name="set_sample-view")
     * @param $id_thing
     * @param $id
     * @param Request $request
     * @param SetSampleRepository $setSampleRepository
     * @param MaterialRepository $materialRepository
     * @param ContainerRepository $containerRepository
     * @param StorageMethodRepository $storageMethodRepository
     * @param LaboratoryRepository $laboratoryRepository
     * @return RedirectResponse|Response
     */
    public function view($id_thing,
                         $id,
                         Request $request,
                         SetSampleRepository $setSampleRepository,
                         MaterialRepository $materialRepository,
                         ContainerRepository $containerRepository,
                         StorageMethodRepository $storageMethodRepository,
                         LaboratoryRepository $laboratoryRepository)
    {
        $setSample = $setSampleRepository->find($id);

        $materials = $materialRepository->findAll();
        if($setSample->getIdMaterial()) {
            usort($materials, function ($a, $b) use ($setSample) {
                return $a->getId() != $setSample->getIdMaterial();
            });
        }
        $setSample->setMaterials($materials);

        $container = $containerRepository->findAll();
        if($setSample->getIdContainer()) {
            usort($container, function ($a, $b) use ($setSample) {
                return $a->getId() != $setSample->getIdContainer();
            });
        }
        $setSample->setContainers($container);

        $storageMethods = $storageMethodRepository->findAll();
        if($setSample->getIdStorageMethod()) {
            usort($storageMethods, function ($a, $b) use ($setSample) {
                return $a->getId() != $setSample->getIdStorageMethod();
            });
        }
        $setSample->setStorageMethods($storageMethods);

        $laboratories = $laboratoryRepository->findAll();
        if($setSample->getIdLaboratory()) {
            usort($laboratories, function ($a, $b) use ($setSample) {
                return $a->getId() != $setSample->getIdLaboratory();
            });
        }
        $setSample->setLaboratories($laboratories);

        $form = $this->createForm(SetSampleType::class, $setSample);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('thing-view', ['id'=>$id_thing]);
        }

        return $this->render('set_sample/view.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
