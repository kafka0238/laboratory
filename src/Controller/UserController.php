<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('user/index.html.twig', [
            'users' => $users,
            'is_show' => $isShow,
        ]);
    }


    /**
     * @Route("/user/create", name="user-create")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $newUser = new User();
        $newUser->setRolesId(3);
        $form = $this->createForm(UserType::class, $newUser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($newUser->getRolesId() == '1') {
                $newUser->setRoles(["ROLE_ADMIN", "ROLE_MANAGER", "ROLE_LABORANT"]);
            } elseif($newUser->getRolesId() == '2') {
                $newUser->setRoles(["ROLE_MANAGER", "ROLE_LABORANT"]);
            } elseif($newUser->getRolesId() == '3') {
                $newUser->setRoles(["ROLE_LABORANT"]);
            }
            $encodedPassword = $passwordEncoder->encodePassword($newUser, $newUser->getPassword());
            $newUser->setPassword($encodedPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();
            return $this->redirectToRoute('user');
        }

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }

    /**
     * @Route("/user/view/{id}", name="user-view")
     * @param $id
     * @param Request $request
     * @param UserRepository $userRepository
     * @return RedirectResponse|Response
     */
    public function view($id, Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $oldUser = $userRepository
            ->find($id);

        if(in_array("ROLE_ADMIN", $oldUser->getRoles())) {
            $oldUser->setRolesId(1);
        } elseif(in_array("ROLE_MANAGER", $oldUser->getRoles())) {
            $oldUser->setRolesId(2);
        } elseif(in_array("ROLE_LABORANT", $oldUser->getRoles())) {
            $oldUser->setRolesId(3);
        }

        $form = $this->createForm(UserType::class, $oldUser);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($oldUser->getRolesId() == '1') {
                $oldUser->setRoles(["ROLE_ADMIN", "ROLE_MANAGER", "ROLE_LABORANT"]);
            } elseif($oldUser->getRolesId() == '2') {
                $oldUser->setRoles(["ROLE_MANAGER", "ROLE_LABORANT"]);
            } elseif($oldUser->getRolesId() == '3') {
                $oldUser->setRoles(["ROLE_LABORANT"]);
            }
            $encodedPassword = $passwordEncoder->encodePassword($oldUser, $oldUser->getPassword());
            $oldUser->setPassword($encodedPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('user');
        }

        $user = $this->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())) {
            $isShow = 1;
        } elseif(in_array('ROLE_MANAGER', $user->getRoles())) {
            $isShow = 2;
        } elseif(in_array('ROLE_LABORANT', $user->getRoles())) {
            $isShow = 3;
        }
        return $this->render('user/view.html.twig', [
            'form' => $form->createView(),
            'is_show' => $isShow,
        ]);
    }
}
