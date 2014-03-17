<?php

namespace GuestBook\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use GuestBook\FrontendBundle\QR\QrCode;
use GuestBook\FrontendBundle\QR\Render\GoogleChartsRenderer;

class GuestService
{
    /*
     * variable for entity manager
     * */
    private $em;

    /*
     * variable for saving local error
     * */
    public $error;

    /**
     * constructor
     * @param $entityManager
     * */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->error = null;
    }

    public function getAllRecords(){
        $guests = $this->em
                    ->getRepository('GuestBookFrontendBundle:Guest')
                    ->findAll();
        return $guests;
    }

    public function getOne($id){
        $guest = $this->em
                    ->getRepository('GuestBookFrontendBundle:Guest')
                    ->find($id);
        if (!$guest)
            return false;
        return $guest;
    }

    public function getQR($id){
        $guest = $this->getOne($id);
        if (!$guest)
            return false;

        $qrCode = new QrCode($guest->getEmail(), 250, 250); // text, width, height 
        $qrCode->setRenderer(new GoogleChartsRenderer());
        $qrCodeData = $qrCode->generate(); // should return the image data, not the URL

        return $qrCodeData;
    }
}