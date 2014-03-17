<?php

namespace GuestBook\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuestBook\FrontendBundle\Entity\Guest;

class MainController extends Controller
{
    public function indexAction(Request $request)
    {
    	$guestService = $this->get('guest.service');
		return $this->render(	
			'GuestBookFrontendBundle:Main:index.html.twig', 
        	array( 
        		'guests' => $guestService->getAllRecords()
		));
    }
}
