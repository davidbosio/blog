<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class UsuarioFixtures extends Fixture implements DependentFixtureInterface
{
    const USUARIO_REFERENCE = 'usrDavid';
    const USUARIO_REFERENCE1 = 'usrprueba';



    public function load(ObjectManager $manager)
    {
        $usuario1 = new Usuario();
        $usuario1->setNombre('david');
        $usuario1->setUsername('david');
        $usuario1->setPlainPassword('david');
        $usuario1->setEmail('davidbosio@gmail.com');
        $usuario1->setEnabled(true);

        $this->addReference(self::USUARIO_REFERENCE, $usuario1);
        $manager->persist($usuario1);


        $usuario2 = new Usuario();
        $usuario2->setNombre('prueba');
        $usuario2->setUsername('prueba');
        $usuario2->setPlainPassword('prueba');
        $usuario2->setEmail('davidbossas@gmail.com');
        $usuario2->setEnabled(true);;


        $this->addReference(self::USUARIO_REFERENCE1, $usuario2);
        $manager->persist($usuario2);

//        $user_manager = $usuario1->set('fos_user.user_manager');


        $manager->flush();

    }

}