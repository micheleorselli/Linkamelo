<?php

namespace Linkamelo\Entity;

require_once 'ReferralUser.php';
require_once 'Objective.php';

/**
 * Un AdminUser è un utente del servizio linkamelo. Può inserire obiettivi, vedere la classifica dei ReferralUser
 * relativa al sito che gestisce (specificato in $site_url)
 * 
 * @author micheleorselli
 */
class AdminUser extends ReferralUser{
  
    protected $password;
    protected $objectives;
    
    public function __construct($email, $password)
    {
        parent::__construct($email);
        $this->password = $password;
        $this->objectives = array();
        
    }
    
    public function getPassword()
    {
        $this->password;
    }
    
    public function setPassword($password)
    {
        return $this->password;
    }
    
    public function getObjectives()
    {
        return $this->objectives;
    }

    public function setObjectives($objectives)
    {
        $this->objectives = $objectives;
    }
    
    public function addObjective($name, $points, $slug)
    {
        $this->objectives[$slug] = new \Linkamelo\Entity\Objective($this->getSiteUrl(), $name, $points, $slug);    
                
    }
    
    public function getObjectiveBySlug($objective_slug)
    {
        if(!array_key_exists($objective_slug, $this->objectives))
        {
          return null;
        }
        
        return $this->objectives[$objective_slug];
    }
}

?>
