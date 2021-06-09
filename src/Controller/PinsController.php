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
      
        #return new Response('<h1>hello word</>');
        $pin = new Pin();
        $pin1 = new Pin();
        $pin->setTitle('Title 1');
        $pin1->setDescription('description 1');
        $pin1->setTitle('Title 2');
        $pin->setDescription('description 2');
       
        $em->persist($pin);
        $em->persist($pin1);
        $em->flush();
        dump($pin);
        return $this->render('pins/index.html.twig');
    }
}
