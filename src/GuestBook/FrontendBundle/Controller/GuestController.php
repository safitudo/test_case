<?php

namespace GuestBook\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GuestBook\FrontendBundle\Entity\Guest;
use GuestBook\FrontendBundle\Form\Type\GuestType;

class GuestController extends Controller
{
    public function addAction(Request $request)
    {
    	$guest = new Guest();
	    $form = $this->createForm(new GuestType(), $guest);
	    

		$form->handleRequest($request);
		$errors = $this->get('validator')->validate($guest);
		
		
		if ($request->getMethod()=="POST" && $form->isValid() && count($errors) == 0) {
	        $em = $this->getDoctrine()->getManager();
    		$em->persist($guest);
    		$em->flush();
    		$this->get('session')->getFlashBag()->add(
	            'success',
	            'New guest '.$guest->getName().' has just been added.'
	        );

    		return $this->redirect($this->generateUrl('homepage'));
	    } elseif ($request->getMethod()=="GET") {
	    	$errors = array();
	    }

        return $this->render('GuestBookFrontendBundle:Guest:add.html.twig', array("form"=>$form->createView(), "errors"=>$errors));
    }

    public function renderAction(Request $request,$id)
    {
    	$QR = $this->get("guest.service")->getQR($id);
    	if (!$QR){
    		return $this->redirect($this->generateUrl('homepage'));
    	}
    	$f = fopen("/tmp/$id.png","w+");
    	fputs($f,$QR);
    	fclose($f);

    	$guest = $this->get("guest.service")->getOne($id);
    	$html = $this->renderView('GuestBookFrontendBundle:PDF:index.html.twig', array("guest"=>$guest,"png"=>$QR));
    	$pdfGenerator = $this->get('spraed.pdf.generator');
    	return new Response($pdfGenerator->generatePDF($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="out.pdf"'
            )
    	);
    }
}
