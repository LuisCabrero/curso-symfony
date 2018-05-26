<?php

namespace AppBundle\Twig;

class HelperVistas extends \Twig_Extension{

	public function getFunctions(){
		return array(
			'generateTable' => new \Twig_Function_Method($this, 'generateTable')
		);
	}


	public function generateTable($num_columns, $num_rows){
		$tabla = "<table class='table'>";
		for ($i=0; $i <= $num_rows ; $i++) { 
			$tabla .= "<tr>";
			for ($j=0; $j <= $num_columns ; $j++) { 
				$tabla .= "<td>Columna</td>";
			}
			$tabla .= "</tr>";
		}
		$tabla .= "</table>";
		return $tabla;
	}

	public function getName(){
		return "app_bundle";
	}

}