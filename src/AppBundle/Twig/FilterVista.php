<?php

namespace AppBundle\Twig;

class FilterVista extends \Twig_Extension{

	public function addText($string){
		return $string." TEXTO CONCATENADO";
	}

	public function getFilters(){
		return array(
			new \Twig_SimpleFilter("addText", array($this, 'addText'))
		);
	}

	public function getName(){
		return "filter_vista";
	}

}