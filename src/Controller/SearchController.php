<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchBarType;
use App\Repository\UserRepository;
/**
  * @Route("/search")
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/", name="search")
     */
    public function index()
    {
                
       return $this->render('user/search.html.twig', [
            'controller_name' => 'SearchController' ]);
    }
 /**
  * @Route("/name", name="search_name",methods={"POST,GET"})
 */
    public function search(Request $request)
    {
                
        $form = $this->createForm(SearchBarType::class,
         ['action' => $this->generateUrl('user_name',array('name'=>'abdou3')),
        'method' => 'GET']);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // encode the plain password
         //  return $this->redirectToRoute('user_name');
           echo "hello";
       }
        return $this->render('user/search.html.twig', [
            'form'=>$form->CreateView()
                   ]);
    }
}
