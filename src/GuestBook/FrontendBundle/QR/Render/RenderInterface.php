<?php

namespace GuestBook\FrontendBundle\QR\Render;

interface RenderInterface{
	public function setData($text, $width, $height);
	public function generate();
}