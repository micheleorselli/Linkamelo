<?php

require_once __DIR__.'/../../../../Linkamelo/Entity/ReferralUser.php';
require_once __DIR__.'/../../../../Linkamelo/Repository/ReferralUserRepository.php';
require_once __DIR__.'/../../../../Linkamelo/Service/ReferralService.php';

/**
 * @author micheleorselli
 */
class ReferralServiceTest extends PHPUnit_Framework_TestCase {
  
  public function testUserReachObjective()
  { 
      $admin_user = new Linkamelo\Entity\AdminUser('admin@example.com', 'password');
      $admin_user->setSiteUrl('www.google.com');
      $admin_user->addObjective('Registrazione', 10, 'registrazione');
      $admin_user->addObjective('Acquisto abbonamento', 50, 'acquisto_abbonamento');
      
      $service = new Linkamelo\Service\ReferralService();
      $user = $service->userReachObjective('www.google.com', 'jhonny@example.com', 'acquisto_abbonamento');

      $this->assertEquals($user->getPoints(), 50);
      
  }
  
}

?>