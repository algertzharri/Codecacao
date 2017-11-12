<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use AppBundle\Entity\Rating;

class DefaultController extends Controller
{
	 /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
	
	
	/**
    * @Route("/addrating", name="addrating")
    */
 
	public function createAction(Request $request)
	{
      $ratings = new Rating;     
 
     # Add form fields
       $form = $this->createFormBuilder($ratings)
       ->add('visitorid', TextType::class, array('label'=> 'visitorid', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
       ->add('uri', TextType::class, array('label'=> 'uri','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
       ->add('rating', TextType::class, array('label'=> 'rating','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
       ->add('Save', SubmitType::class, array('label'=> 'submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
       ->getForm();
 
    
	   $form->handleRequest($request);
		   
		   if($form->isSubmitted() &&  $form->isValid()){
           $visitorid = $form['visitorid']->getData();
           $uri = $form['uri']->getData();
           $rating = $form['rating']->getData();
 
			# set form data   
 
           $ratings->setVisitorid($visitorid);
           $ratings->setUri($uri);          
           $ratings->setRating($rating);                
 
			# finally add data in database
 
           $sn = $this->getDoctrine()->getManager();      
           $sn -> persist($ratings);
           $sn -> flush();
		   
			
			return $this->render('default/sendrating.html.twig',array('visitorid' => $visitorid, 'uri' => $uri, 'rating' => $rating));
			}
		
			
		   return $this->render('default/addrating.html.twig', ['form' => $form->createView()]);
		   
 
		
   }
}
