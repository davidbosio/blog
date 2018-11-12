<?php

namespace AppBunde\DataFixture\ORM;

use AppBundle\DataFixtures\ORM\UsuarioFixtures;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
            $post1 = new Post();
            $post1->setTitulo('Primer fixtures');
            $post1->setAuthor($this->getReference(UsuarioFixtures::USUARIO_REFERENCE));
            $post1->setCuerpo('cuerpo de prueba');
            $post1->setFechaDeCreacion(date('Y-m-d'));
            $post1->setEstado($this->getReference(CategoriaFixtures::CATEGORIA_REFERENCE));
            $manager->persist($post1);
            $manager->flush();

            $post2 = new Post();
            $post2->setTitulo('Sencond fixtures');
            $post2->setAuthor($this->getReference(UsuarioFixtures::USUARIO_REFERENCE1));
            $post2->setCuerpo('cuerpo de prueba, expecion: Twitter');
            $post2->setFechaDeCreacion(date('Y-m-d'));
            $post2->setEstado($this->getReference(CategoriaFixtures::CATEGORIA_REFERENCE1));
            $manager->persist($post2);
            $manager->flush();
        }

    public function getDependencies()
    {
        return array(
            CategoriaFixtures::class,
            UsuarioFixtures::class,
        );
    }

}
?>