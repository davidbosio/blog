<?php
namespace AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Post;
use AppBundle\Service\PostServices;


class PostListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $post = $args->getObject();
        $em = $args->getEntityManager();
        $servicio= new PostServices($em);
        $texto=$servicio->changeBody($post->getCuerpo());
        $post->setCuerpo($texto);
        $em->persist($post);
        $em->flush();

    }
}