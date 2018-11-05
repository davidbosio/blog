<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testLoginTittle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'login');

        $this->assertContains('Iniciar Sesion', $crawler->filter('h1')->text());
    }

    public function testListarTittle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'posts/list');

        $this->assertContains('Inicio', $crawler->filter('h1')->text());
    }

    public function testListarContent()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'posts/list');

        $this->assertContains('Aun no se ha cargado ningun post', $crawler->filter('body')->text());
    }
}