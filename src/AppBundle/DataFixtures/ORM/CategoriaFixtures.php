<?php

namespace AppBunde\DataFixture\ORM;

use AppBundle\Entity\Categoria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CategoriaFixtures extends Fixture implements DependentFixtureInterface
{

    const CATEGORIA_REFERENCE = 'catBorrador';
    const CATEGORIA_REFERENCE1 = 'catActivo';


    public function load(ObjectManager $manager)
    {
        $categoria1 = new Categoria();
        $categoria1->setDescripcion('Borrador');
        $this->addReference(self::CATEGORIA_REFERENCE, $categoria1);
        $manager->persist($categoria1);


        $categoria2 = new Categoria();
        $categoria2->setDescripcion('Activo');
        $this->addReference(self::CATEGORIA_REFERENCE1, $categoria2);
        $manager->persist($categoria2);


        $manager->flush();

    }

}