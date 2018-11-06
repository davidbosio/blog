<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\PostController;
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
        $client = static::createClient();
        $crawler=$client->request('GET', '/login');
        $form = $crawler->selectButton("_submit")->form();
        $form['_username']='david';
        $form['_password']='aaaaa';
        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));

        $form['_username']='david';
        $form['_password']='david';
        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/posts/list'));


    }

    public function testCreate()
    {

    }

}