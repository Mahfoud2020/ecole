<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\SearchBarType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// encoder
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
    */ 
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
               'users' => $userRepository->findAll()
        ]);
    
    }
    /**
     * @Route("/role/{role?null}", name="user_index_role", methods={"GET"})
     */
    public function index_role(UserRepository $userRepository, $role): Response
    {
        return $this->render('user/index.html.twig', [
            //'users' => $userRepository->findAll()
            'users' => $userRepository->getUsersRoles($role),
            'role' => $role
            // 'users' => $userRepository->findOneRole(3)
        ]);
    }
    /**
     * @Route("/name/{name?null}", name="user_name", methods={"GET","POST"})
     */
    public function user_name(UserRepository $userRepository, $name, Request $request): Response
    {
        if ($request->get('search') !=null) 
        {
            $name = $request->get('search');
           // $this->redirectToRoute('user_name');
            
        }
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->ByUserName($name),
            'name' => $name
        ]);
    }
    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$user->addRole('ROLE_USER');
            $user->updateRole('ROLE_'.$form->get('role')->getData()->getNom());
            $hash = $passwordEncoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
          // sauvegarde  
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->updateRole('ROLE_'.$form->get('role')->getData()->getNom());
            //
            $hash = $passwordEncoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            //
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
