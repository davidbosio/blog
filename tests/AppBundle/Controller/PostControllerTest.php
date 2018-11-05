<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testLoginTittle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'login');

        $this->assertContains('Iniciar Sesion', $crawler->filter('h1')->text());
    }

    public function testListTittle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'posts/list');

        $this->assertContains('Inicio', $crawler->filter('h1')->text());
    }

    public function testListStatusCode(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/posts/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testLogIn()
    {
        $client = $this->makeClient(true);
        $crawler=$client->request('GET', '/login');
        $form = $crawler->selectButton("_submit")->form();
        $form['_username']='david';
        $form['_password']='david';
        $crawler = $client->submit($form);
        var_dump($crawler);
        $this->assertTrue(
            $client->getResponse()->isRedirect('/posts/list/')
        );
    }

}