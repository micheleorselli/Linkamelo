<?php

namespace Linkamelo\Entity;

require_once __DIR__.'/../Service/ReferralService.php';

/**
 * Un ReferralUser è un utente che riceve un proprio link univoco (per sito) e successivamente lo shara
 * 
 * @author micheleorselli
 */
class ReferralUser{
  
    protected $email;
    protected $site_url;
    protected $referral_code;
    
    protected $referred;
    
    protected $points;
    
    public function __construct($email)
    {
        $this->email      = $email;
        $this->site_url   = null;
        $this->referral_code  = null;
        $this->points     = 0;
    }
    
    public function getSiteUrl()
    {
        return $this->site_url;
    }
    
    public function setSiteUrl($site_url)
    {   
        $site_code = md5($this->email.$site_url);
        
        $this->site_url   = $site_url;
        $this->referral_code  = $site_code;  
    }
    
    public function getReferralCode()
    {
        return $this->referral_code;
    }
    
    public function getPoints()
    {
        return $this->points;
    }
    
    public function addPoints($points)
    {
        $this->points += $points;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function referredBy(ReferralUser $user)
    {
        $this->referred = $user;
    }
    
    public function getReferredBy()
    {
        return $this->referred;
    }
    
}

?>
