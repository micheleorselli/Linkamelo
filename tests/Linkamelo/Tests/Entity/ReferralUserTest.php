<?php
 
require_once __DIR__.'/../../../../Linkamelo/Entity/ReferralUser.php';

/**
 * @author micheleorselli
 */
class ReferralUserTest extends PHPUnit_Framework_TestCase {
  
  public function setUp()
  {
      $this->user = new \Linkamelo\Entity\ReferralUser('ciccio@example.com');
  }
  
  public function testNewUserShouldSpecifyEmailAndPassword()
  {
      $this->assertEquals(get_class($this->user), 'Linkamelo\Entity\ReferralUser');
  }
  
  public function testNewUserShouldntHaveAssociatedSite()
  {
      $this->assertNull($this->user->getSiteUrl());
  }
  
  public function testShouldGetAnUniqueCodeForASite()
  {   
      $this->user->setSiteUrl('http://www.google.com');
              
      $this->assertEquals($this->user->getReferralCode(), '13220ef7daefbf54e9a12d0ad959f9fe');
  }
  
}

?>
