<?php

namespace GuestBook\FrontendBundle\QR\Render;

use GuestBook\FrontendBundle\QR\Render\RenderInterface;

class GoogleChartsRenderer implements RenderInterface{

	private $text;
	private $width;
	private $height;

	public function setData($text, $width, $height){
		$this->text = $text;
		$this->width = $width;
		$this->height = $height;
	}

	public function generate(){
		$url = "https://chart.googleapis.com/chart?cht=qr&chs=".$this->width."x".$this->height."&chl".urlencode($this->text);
		return file_get_contents($url);
	}
}