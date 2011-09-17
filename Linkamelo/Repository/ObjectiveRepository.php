<?php

namespace Linkamelo\Repository;

require_once __DIR__.'/../Entity/Objective.php';
        
/**
 * @author micheleorselli
 */
class ObjectiveRepository{
  
    protected $objectives_by_slug;
  
    public function __construct()
    {
       $obj = new \Linkamelo\Entity\Objective('www.google.com', 'Acquisto', 50, 'acquisto_abbonamento');
       $this->objectives[$obj->getSiteUrl().$obj->getSlug()] = $obj;
       
       $obj = new \Linkamelo\Entity\Objective('www.google.com', 'Registrazione', 5, 'registrazione');
       $this->objectives[$obj->getSiteUrl().$obj->getSlug()] = $obj;
       
       $obj = new \Linkamelo\Entity\Objective('www.google.com', 'Posta', 30, 'invio_posta');
       $this->objectives[$obj->getSiteUrl().$obj->getSlug()] = $obj;
       
       $obj = new \Linkamelo\Entity\Objective('www.yahoo.com', 'Registrazione', 50, 'registrazione');
       $this->objectives[$obj->getSiteUrl().$obj->getSlug()] = $obj;
       
       $obj = new \Linkamelo\Entity\Objective('www.facebook.com', 'Registrazione', 20, 'registrazione');
       $this->objectives[$obj->getSiteUrl().$obj->getSlug()] = $obj;
       
       $obj = new \Linkamelo\Entity\Objective('www.facebook.com', 'Wall', 30, 'post_wall');
       $this->objectives[$obj->getSiteUrl().$obj->getSlug()] = $obj;
       
          
       $this->objectives[$obj->getSiteUrl().$obj->getSlug()] = $obj;
    }
    
    public function findObjectiveBySiteUrlAndSlug($site_url, $slug)
    {
        return $this->objectives[$site_url.$slug];
    }
    
}

?>
