<?php

namespace App\Controller;
####for create forms#####
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request; ###

use App\Entity\Sport; ####
class SportcalenderController extends AbstractController
{
################## HOME CONTROLLER ###########################
    #[Route('/', name: 'home')]
    public function index(): Response
    {// Here we will use getDoctrine to use doctrine and we will select the entity that we want to work with and we used findAll() to bring all the information from it and we will save it inside a variable named sports and the type of the result will be an array
        $sports = $this->getDoctrine()->getRepository('App:Sport')->findAll();
        return $this->render('sportcalender/index.html.twig', array('sports'=>$sports));
        
    // we send the result (the variable that have the result of bringing all info from our database) to the index.html.twig page
    }
################## CREATE CONTROLLER ###########################
    #[Route('/create', name: 'sport_create')]
    public function createAction(Request $request): Response
    {
       // Here we create an object from the class that we made

    $sport = new Sport;

       /* Here we will build a form using createFormBuilder and inside this function we will put our object and then we write add then we select the input type then an array to add an attribute that we want in our input field */
       
        $form = $this->createFormBuilder($sport)->add('name', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px','id'=>'Formular')))
       
        ->add('category', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       
        ->add('description', TextareaType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
       
        ->add('priority', ChoiceType::class, array('choices'=>array('Low'=>'Low', 'Normal'=>'Normal', 'High'=>'High'),'attr' => array('class'=> 'form-control', 'style'=>'margin-botton:15px')))
       
        ->add('due_date', DateTimeType::class, array('attr' => array('style'=>'margin-bottom:15px')))

        ->add('picture',TextType::class, array('attr' => array('style'=>'margin-bottom:5px')))
       
        ->add('save', SubmitType::class, array('label'=> 'Create sport', 'attr' => array('class'=> 'btn-primary', 'style'=>'margin-bottom:15px')))
       
        ->getForm();
       
        $form->handleRequest($request);
     /* Here we have an if statement, if we click submit and if  the form is valid we will take the values from the form and we will save them in the new variables */
       
        if($form->isSubmitted() && $form->isValid()){
       
//fetching data
       
       
// taking the data from the inputs by the name of the inputs then getData() function
       
        $name = $form['name']->getData();
       
        $category = $form['category']->getData();
       
        $description = $form['description']->getData();
       
        $priority = $form['priority']->getData();
       
        $due_date = $form['due_date']->getData();

        $picture = $form['picture']->getData();
       
        
       
       // Here we will get the current date
       
        $now = new \DateTime('now');//new\DateTime alt version
       
       
       /* these functions we bring from our entities, every column have a set function and we put the value that we get from the form */
       
        $sport->setName($name);
       
        $sport->setCategory($category);
       
        $sport->setDescription($description);
       
        $sport->setPriority($priority);
       
        $sport->setDueDate($due_date);
       
        $sport->setCreateDate($now);

        $sport->setPicture($picture);
       
        $em = $this->getDoctrine()->getManager();
       
        $em->persist($sport);
       
        $em->flush();
       
        $this->addFlash(
       
        'notice',
       
        'sport Added'
       
        );
       
        return $this->redirectToRoute('home');
       
        }
       
        /* now to make the form we will add this line form->createView() and now you can see the form in create.html.twig file  */
       
        return $this->render('sportcalender/create.html.twig', array('form' => $form->createView()));
       
        
    }
################## DETAILS CONTROLLER ###########################
    #[Route('/details{$id}', name: 'sport_details')]
    public function detailsAction($id): Response
    {
        $sport = $this->getDoctrine()->getRepository('App:Sport')->find($id);
        return $this->render('sportcalender/details.html.twig', array('sport' => $sport));
    }
################## EDIT CONTROLLER ###########################
    #[Route('/edit', name: 'sport_edit')]
    public function editAction(): Response
    {
        return $this->render('sportcalender/edit.html.twig', [
            'controller_name' => 'SportcalenderController',
        ]);
    }

}
