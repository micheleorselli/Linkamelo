<?php

namespace Linkamelo\Entity;

/**
 * 
 * @author micheleorselli
 */
class Objective
{
  
    protected $site_url;
    protected $name;
    protected $points;
    protected $slug;
    
    public function __construct($site_url, $name, $points, $slug)
    {
        $this->site_url = $site_url;
        $this->name = $name;
        $this->points = $points;
        $this->slug = $slug;
    }
    
    public function getSiteUrl() {
      return $this->site_url;
    }

    public function getName() {
      return $this->name;
    }

    public function getPoints() {
      return $this->points;
    }

    public function getSlug() {
      return $this->slug;
    }


}

?>
