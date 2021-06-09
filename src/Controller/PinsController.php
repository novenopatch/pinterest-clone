<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinsController extends AbstractController
{
    
   
    public function index(PinRepository $repo): Response
    {
      
        
       
       #ne fonctione que au niveau des controler

        return $this->render('pins/index.html.twig',['pins'=>$repo->findAll()]);
    }
}
