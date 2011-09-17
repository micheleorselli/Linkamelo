<?php
namespace Linkamelo\Tests;

require __DIR__.'/../../../silex.phar';

use Silex\WebTestCase;

class LinkameloApiTest extends WebTestCase
{
    public function createApplication()
    {
      $app = require __DIR__.'/../../../linkamelo.php';
      $app['debug'] = true;
      unset($app['exception_handler']);

      return $app;
    } 
    
    public function testGetReferralLink()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/www.google.com/michele@example.com/referral_link');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
        
        $this->assertEquals('Condividi abbestia questo link http://www.google.com/user/register/0e2cf35a0ecebf512b349759a1edacb5 !!!',
                            json_decode($client->getResponse()->getContent()));
    }    
    
    public function testAddReferral()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/www.google.com/jhonny@example.com/referred_by/0e2cf35a0ecebf512b349759a1edacb5');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
        
        $this->assertEquals('Bravo jhonny@example.com! adesso quando condividi fai guadagnare michele@example.com!!!',
                            json_decode($client->getResponse()->getContent()));
    }    
    
    public function testUserReachObjective()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/www.google.com/jhonny@example.com/objective/acquisto_abbonamento');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
        
        $this->assertEquals("Bravo jhonny@example.com! Raggiungendo l'obiettivo acquisto_abbonamento hai fatto guadagnare punti a michele@example.com !!!",
                            json_decode($client->getResponse()->getContent()));
    }    
}

?>
