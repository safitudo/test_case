<?php

namespace GuestBook\FrontendBundle\QR;
use GuestBook\FrontendBundle\QR\Render\RenderInterface;

class QrCode{

	private $text;
	private $width;
	private $height;

	private $renderInterface;

	public function __construct($text, $width, $height){
		$this->text = $text;
		$this->width = $width;
		$this->height = $height;
	}

	public function setRenderer(RenderInterface $renderInterface){
		$this->renderInterface = $renderInterface;
		$this->renderInterface->setData($this->text, $this->width, $this->height);
	}

	public function generate(){
		return $this->renderInterface->generate();
	}
}