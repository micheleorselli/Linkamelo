<?php
 
require_once __DIR__.'/../../../../Linkamelo/Entity/AdminUser.php';

/**
 * @author micheleorselli
 */
class AdminUser extends PHPUnit_Framework_TestCase {
  
  public function setUp()
  {
      $this->user = new \Linkamelo\Entity\AdminUser('ciccio@example.com', 'password');
      $this->user->setSiteUrl('http://www.google.com');
  }
  
  public function testNewUserShouldSpecifyEmailAndPassword()
  {
      $this->assertEquals(get_class($this->user), 'Linkamelo\Entity\AdminUser');
  }
  
  public function testNewAdminShouldNotHaveAnyObjectives()
  {
      $this->assertEquals($this->user->getObjectives(), array());
  }
  
  public function testCanAddAnObjective()
  {
      $this->user->addObjective('Registrazione', 10, 'registrazione');
      $this->user->addObjective('Acquisto abbonamento', 50, 'acquisto_abbonamento');
      
      
      $expected = new \Linkamelo\Entity\Objective('http://www.google.com', 'Acquisto abbonamento', 50, 'acquisto_abbonamento');
      
      $this->assertEquals($this->user->getObjectiveBySlug('acquisto_abbonamento'), $expected);
  }
}

?>
