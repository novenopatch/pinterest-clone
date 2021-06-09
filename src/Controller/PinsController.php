<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PinsController extends AbstractController
{
    
   
    public function index(PinRepository $repo): Response
    {
      
       
       
       #ne fonctione que au niveau des controler

        return $this->render('pins/index.html.twig',['pins'=>$repo->findAll()]);
    }
    public function create(Request $request,EntityManagerInterface $em): Response
    {
        if($request->isMethod('POST')){
           $data= $request->request->all();
           if($this->isCsrfTokenValid('pins_create',$data['_token'])){
            $pin = new Pin();
            $pin->setTitle($data['title']);
            $pin->setDescription($data['description']);
 
 
            $em->persist($pin);
            
            $em->flush();
           }
           
           #return $this->redirect($this->generateUrl('app_home'));
           return $this->redirect('https://www.google.com');
           return $this->redirectToRoute('app_home');
        }
        
       
       #ne fonctione que au niveau des controler

        return $this->render('pins/create.html.twig');
    }
}
