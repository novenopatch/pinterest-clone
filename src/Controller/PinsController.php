<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $form = $this->createFormBuilder()
            ->add('title', TextType::class)
            ->add('description',TextareaType::class)
            ->add('submit',SubmitType::class,['label'=>'Create Pin'])
            ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $pin = new Pin;
            $pin->setTitle($data['title']);
            $pin->setDescription($data['description']);
            $em->persist($pin);
            $em->flush();

            return $this->redirectToRoute('app_home');

        }

        return $this->render('pins/create.html.twig',['form'=> $form->createView()]);
    }
}
