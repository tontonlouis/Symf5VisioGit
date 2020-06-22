<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PageControllerTest extends WebTestCase
{

    public function testPageContact()
    {
        $client = static::createClient();
        $client->request('GET', "/contact");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testH1ContactPage()
    {
        $client = static::createClient();
        $client->request('GET', "/contact");
        $this->assertSelectorTextContains('h1', 'Contacter nous');
    }

    public function testH2ContactPage()
    {
        $client = static::createClient();
        $client->request('GET', "/contact");
        $this->assertSelectorTextContains('h2', 'Formulaire');
    }

    
}