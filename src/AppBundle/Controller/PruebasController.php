<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PruebasController extends Controller
{

    public function indexAction(Request $request, $name, $page)
    {
        /*var_dump($request->query->get("hola"));
        var_dump($request->get("holaPost"));
        exit;*/

        $productos  = array(
                    array("producto"=>"Consola", "precio"=>2),
                    array("producto"=>"Consola 2", "precio"=>3),
                    array("producto"=>"Consola 3", "precio"=>4),
                    array("producto"=>"Consola 4", "precio"=>5),
                    array("producto"=>"Consola 5", "precio"=>6),
                    array("producto"=>"Consola 6", "precio"=>7)
        );
        $fruta = array("manzana"=>"golden", "pera"=>"rica");

        // replace this example code with whatever you need
        return $this->render('AppBundle:Pruebas:index.html.twig', array(
            'texto' => $name." ".$page,
            'productos' => $productos,
            'fruta' => $fruta
        ));
    }
}
