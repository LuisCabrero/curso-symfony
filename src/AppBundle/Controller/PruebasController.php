<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//Modelos
use AppBundle\Entity\Curso;

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

    public function createAction(){
        $curso = new Curso();
        $curso->setTitulo("Office");
        $curso->setDescripcion("Curso completo office");
        $curso->setPrecio(80);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($curso);
        $flush = $em->flush();

        if($flush != null){
            echo "El curso no se ha creado bien";
        }else{
            echo "El curso se ha creado correctamente";
        }
        exit;
    }

    public function readAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $cursos_repo = $em->getRepository("AppBundle:Curso");
        $cursos = $cursos_repo->findAll();

        $cursos_80 = $cursos_repo->findBy(array("precio"=>80));

        //Se puede hacer también findOneByPrecio(80)

        foreach ($cursos_80 as $key => $curso) {
            echo $curso->getTitulo().'<br>';
            echo $curso->getDescripcion().'<br>';
            echo $curso->getPrecio().'<br><hr>';
        }

        echo "<h1>Pruebas con el query builder</h1>";

        //DQL

        $cursos_repo = $em->getRepository("AppBundle:Curso");

        $query = $cursos_repo->createQueryBuilder("c")
            ->where("c.precio > :precio")
            ->setParameter("precio", 79)
            ->getQuery();

        $cursos = $query->getResult();

        foreach ($cursos_80 as $key => $curso) {
            echo $curso->getTitulo().'<br>';
            echo $curso->getDescripcion().'<br>';
            echo $curso->getPrecio().'<br><hr>';
        }

        exit;
    }

    public function updateAction($id, $titulo, $descripcion, $precio){
        $em = $this->getDoctrine()->getEntityManager();
        $cursos_repo = $em->getRepository("AppBundle:Curso");

        $curso = $cursos_repo->find($id);
        $curso->setTitulo($titulo);
        $curso->setDescripcion($descripcion);
        $curso->setPrecio($precio);

        $em->persist($curso);
        $flush = $em->flush();

        if($flush != null){
            echo "El curso no se ha actualizado bien";
        }else{
            echo "El curso se ha actualizado correctamente";
        }
        exit;

    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $cursos_repo = $em->getRepository("AppBundle:Curso");

        $curso = $cursos_repo->find($id);
        $em->remove($curso);
        $flush = $em->flush();


        if($flush != null){
            echo "El curso no se ha borrado bien";
        }else{
            echo "El curso se ha borrado correctamente";
        }
        exit;
    }
}
