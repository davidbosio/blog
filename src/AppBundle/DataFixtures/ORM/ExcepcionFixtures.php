<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Excepciones;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ExcepcionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Create a common place
        $excepcion1 = new Excepciones();
        $excepcion1->setDescripcion('Twitter');

        $manager->persist($excepcion1);
        $manager->flush();

    }
}