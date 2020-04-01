<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="security_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    { 
        $user = new User(); 
        $regForm = $this->CreateForm(RegisterType::class, $user);
        $regForm->handleRequest($request,$user);
        if ($regForm->isSubmitted() && $regForm->isValid()) {
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $user->addRole('ROLE_USER');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            //$this->addFlash('success', 'Votre compte à bien été enregistré.');
            return $this->redirectToRoute('security_login');
        }    
           // return $this->redirectToRoute('task_success');
        return $this->render('security/register.html.twig', [
            'regform' => $regForm->createView()
        ]);
    }
    /**
     * @Route("/login", name="security_login")
     */
   
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
             'last_username' => $lastUsername,
             'error'         => $error,
         ]);
         return $this->redirectToRoute('admin');
         //$response = $this->forward('App\Controller\HomeController::admin', [
         //   'name'  => '$lastUsername'
        //]);
    }
}
