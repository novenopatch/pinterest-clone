<?php

namespace App\Controller;

use App\Entity\Pin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinsController extends AbstractController
{
    
   
    public function index(EntityManagerInterface $em): Response
    {
      
        
        $repo = $em->getRepository(Pin::class);
        $pins =($repo->findAll());

        return $this->render('pins/index.html.twig',['pins'=>$pins]);
    }
}
