<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;
use AppBundle\Entity\Excepciones;

/**
 * @Route("/api")
 */
class PostApiController extends Controller
{
    /**
     * @Route("/posts/body", methods="GET")
     */
    public function showBody(){
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        $excepciones=$this->getDoctrine()->getRepository('AppBundle:Excepciones')->findAll();

        //GUARDO EN UN ARREGLO VACIO TODAS LAS DESCRIPCIONES DE LAS EXCEPCIONES
        $excepcionArray=array();
        foreach ($excepciones as $excepcion){
            $excepcionArray[]=$excepcion->getDescripcion();
        }
        //GUARDO EN UN ARREGLO VACIO TODOS LOS CUERPOS DE LOS POSTS
        $postsArray=array();
        foreach ($posts as $post){
            //GUARDO EN $CADENA EL CUERPO DEL POST EN CUESTION
            $cadena=$post->getCuerpo();
            //PASO CADA PALABRA DE LA CADENA A UNA POSICION DE ARREGLO
            $palabras=explode(" ", $cadena);
            //ME FIJO SI ALGUNA PALABRA SE ENCUENTRA EN EL ARREGLO DE EXPCIONES
            //SI ENCUENTRA COINCIDENCIA REEMPLAZA LA PALABRA POR ASTERISCOS
            for($x=0; $x<count($palabras); $x++){
                if(in_array($palabras[$x], $excepcionArray)){
                    $palabras[$x]="*****";
                }
            }
            //JUNTA LAS PALABRAS EN UN ARREGLO
            $cadena=implode(" ", $palabras);
            $postArray=array();
            //GUARDO LOS DATOS DEL ARREGLO EN UN ARRAY
            $postArray['id']=$post->getId();
            $postArray['cuerpo']=$cadena;
            $postsArray[]=$postArray;
        }
        return new JsonResponse($postsArray);
    }

    /**
     * @Route("/posts/insert/{id}", methods="PUT")
     */
    public function InsertarAction($id){
        return new Response();
    }
}