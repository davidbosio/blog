<?php


namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;

class PostServices
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function changeBody($plaintext){
        $palabrasArray=explode(" ", $plaintext);
        for($x=0; $x<count($palabrasArray); $x++){
            if($this->em->getRepository('AppBundle:Excepciones')->findOneBy(array('descripcion' => $palabrasArray[$x]))){
           // if(in_array($palabras[$x], $excepcionArray)){
                $palabrasArray[$x]="*****";
            }
        }
        $plaintext=implode(" ", $palabrasArray);
        return $plaintext;
    }
}