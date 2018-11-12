<?php
namespace AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Post;
use AppBundle\Service\PostServices;


class PostListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if(method_exists($object, 'getCuerpo')){
            $em = $args->getEntityManager();
            $servicio= new PostServices($em);
            $texto=$servicio->changeBody($object->getCuerpo());
            $object->setCuerpo($texto);
            $em->persist($object);
            $em->flush();
        }


    }
}