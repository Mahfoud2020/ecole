<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/sidebar", name="sidebar")
     */
    public function sidebar()
    {
        return $this->render('sidebar.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
     /**
     * @Route("/slider", name="slider")
     */
    public function slide()
    {
        return $this->render('home/slider.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(string $name = null)
    {
        return $this->render('sidebar.html.twig', [
            'user_name' => $name,
        ]);
       
    }
}
