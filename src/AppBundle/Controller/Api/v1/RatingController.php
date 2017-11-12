<?php

namespace AppBundle\Controller\Api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Rating;

class RatingController extends Controller
{
	/**
	 * @Route("/api/v1/rating")
	 * @Method("POST")
	 */
	public function newAction(Request $request) {
	
    // Get the Query Parameters from the URL
    // We will trust that the input is safe (sanitized)
    $visitoridQuery = $request->query->get('visitorid');
    $uriQuery = $request->query->get('uri');
	$ratingQuery = $request->query->get('rating');

    // Create a new empty object
    $rating = new Rating();

    // Use methods from the Rating entity to set the values
    $rating->setVisitorid($visitoridQuery);
    $rating->setUri($uriQuery);
	$rating->setRating($ratingQuery);

		if(empty($visitoridQuery) || empty($uriQuery) || empty($ratingQuery))
		{
			$response = new Response();
			$response->setContent(json_encode(array(
				'status' => 'failure',
				'reason' => 'Null values are not allowed'))
				);
			return $response;
		} else 
		{
			// Get the Doctrine service and manager
			$em = $this->getDoctrine()->getManager();

			// Add our rating to Doctrine so that it can be saved
			$em->persist($rating);

			// Save our rating
			$em->flush();
	
			$successfully = Response::HTTP_OK;
		
			$response = new Response();
			if ($successfully == 200) {
				$response->setContent(json_encode(array(
					'status' => 'success',
					'visitor_id' => $visitoridQuery,
					'uri' => $uriQuery,
					'rating' => $ratingQuery))
				);
			} else {
				$response->setContent(json_encode(array(
				'status' => 'failure',
				'reason' => 'unknown error'))
				);
			}
			return $response;
		}
	}
	
	/**
	 * @Route("/api/v1/rating/{id}")
	 * @Method("GET")
	 * @param $id
	 */
	public function getAction($id) {
		
		
		
		$rating = $this->getDoctrine()
		->getRepository('AppBundle:Rating')
		->findOneBy(['id' => $id]);
		
		$data = [
			'visitor_id' => $rating->getVisitorid(),
			'uri' => $rating->getUri(),
			'rating' => $rating->getRating(),
		];
		
		
		$response= new Response(json_encode(array(
					'status' => 'success',
					'visitor_id' => $rating->getVisitorid(),
					'uri' => $rating->getUri(),
					'rating' => $rating->getRating()))
				);
		$response->headers->remove('Cache-Control');
		
		$response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
		
		
	}
	
	
	/**
	 * Show the results in twig html page
	 * @Route("/ratingview/{id}")
	 * @Method("GET")
	 * @param $id
	 */
	public function getActionTwig($id) {
		
		
		
		$rating = $this->getDoctrine()
		->getRepository('AppBundle:Rating')
		->findOneBy(['id' => $id]);
		
		$data = [
			'visitorid' => $rating->getVisitorid(),
			'uri' => $rating->getUri(),
			'rating' => $rating->getRating(),
		];
		
		
		$response= new Response(json_encode(array(
					'status' => 'success',
					'visitor_id' => $rating->getVisitorid(),
					'uri' => $rating->getUri(),
					'rating' => $rating->getRating()))
				);
		$response->headers->remove('Cache-Control');
		
		
		
		return $this->render('default/ratingview.html.twig', array('response' => $response,'visitorid' => $rating->getVisitorid(), 'uri' => $rating->getUri(), 'rating' => $rating->getRating()));
		
		
	}
}
