<?php

namespace Linkamelo\Repository;

require_once __DIR__.'/../Entity/ReferralUser.php';
        
/**
 * Un ReferralUser è un utente che riceve un proprio link univoco (per sito) e successivamente lo shara
 * 
 * @author micheleorselli
 */
class ReferralUserRepository{
  
    protected $users_by_referral;
    protected $users_by_email;
    
    
    public function __construct()
    {
       for($i = 0; $i < 8; $i++)
       {
          $user = new \Linkamelo\Entity\ReferralUser('banana_'.$i.'@example.com');
          $user->setSiteUrl('http://www.google.com');
          
          $this->users_by_referral[$user->getReferralCode()] = $user;
          $this->users_by_email[$user->getEmail()] = $user;
          $this->users_by_site_and_email[$user->getSiteUrl().$user->getEmail()] = $user;
       }
       
          $michele = new \Linkamelo\Entity\ReferralUser('michele@example.com');
          $michele->setSiteUrl('www.google.com');
          
          $this->users_by_referral[$michele->getReferralCode()] = $michele;
          $this->users_by_email[$michele->getEmail()] = $michele;
          $this->users_by_site_and_email[$michele->getSiteUrl().$user->getEmail()] = $michele;
          
          $jhonny = new \Linkamelo\Entity\ReferralUser('jhonny@example.com');
          $jhonny->setSiteUrl('www.google.com');
          $jhonny->referredBy($michele);
          
          $this->users_by_referral[$jhonny->getReferralCode()] = $jhonny;
          $this->users_by_email[$jhonny->getEmail()] = $jhonny;
          $this->users_by_site_and_email[$jhonny->getSiteUrl().$jhonny->getEmail()] = $jhonny;
    }
    
    public function findByReferral($referral_code)
    {   
        if (array_key_exists($referral_code, $this->users_by_referral))
        {
            return $this->users_by_referral[$referral_code];
        }
        
        return null;
    }
    
    public function findByEmail($email)
    {   
        if (array_key_exists($email, $this->users_by_email))
        {
            return $this->users_by_email[$email];
        }
        
        return null;
    }
    
    public function findBySiteAndEmail($site, $email)
    {   
        if (array_key_exists($site.$email, $this->users_by_site_and_email))
        {
            return $this->users_by_site_and_email[$site.$email];
        }
        
        return null;
    }
    
    public static function save(\Linkamelo\Entity\ReferralUser $user)
    {
        //sad but it does nothing for now
        return null;
    }
    
}

?>
