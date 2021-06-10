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
    public function show(PinRepository $repo,int $id): Response{
        $pin = $repo->find($id);
        return $this->render('pins/show.html.twig',compact('pin'));
    }
    public function create(Request $request,EntityManagerInterface $em): Response
    {
       $pin = new Pin;
        $form = $this->createFormBuilder($pin)
            ->add('title', null,['attr'=>['autofocus'=>'true']])
            ->add('description',null,[
                'required'=>false,'attr'=>['row'=>'10','cols'=>'60']
                ])
            ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_home');

        }

        return $this->render('pins/create.html.twig',['form'=> $form->createView()]);
    }
}
