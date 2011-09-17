<?php

namespace Linkamelo\Service;

require_once __DIR__.'/../Repository/ReferralUserRepository.php';
require_once __DIR__.'/../Repository/ObjectiveRepository.php';

/**
 * Facade per tutte le operazioni
 *
 * @author micheleorselli
 */
class ReferralService {
  
  protected $db;
  
  public function __construct(\Doctrine\DBAL\Connection $db)
  {
    $this->db = $db;
  }
    
  /**
   * Registra il fatto che l'utente $email sul sito $site ha raggiunto l'obiettivo $objective_slug
   * aggiornando di conseguenza i punti 
   * 
   * @param string $site            URL del sito
   * @param string $email           L'email con il quale l'utente è registrato sul sito
   * @param string $objective_slug 
   * 
   */
  public function userReachObjective($site, $email, $objective_slug)
  {   
      $user_repo = new \Linkamelo\Repository\ReferralUserRepository($this->db);
      
      $user_referral = $user_repo->findBySiteAndEmail($site, $email)
                                 ->getReferredBy();
      
      $objective_repo = new \Linkamelo\Repository\ObjectiveRepository();
      $objective = $objective_repo->findObjectiveBySiteUrlAndSlug($site, $objective_slug);

      $user_referral->addPoints($objective->getPoints());
      
      return $user_referral;
  }
  
  /**
   * Genera un link che l'utente $email registrato sul sito $site può condividere 
   * per guadagnare punti.
   * 
   * @TODO: rendere la landing page configurabile
   * 
   * @param string $site   URL del sito
   * @param string $email  L'email con il quale l'utente è registrato sul sito
   * 
   * @return string il link che l'utente può condividere 
   */
  public function generateReferralLink($site, $email)
  {
      $user_repo = new \Linkamelo\Repository\ReferralUserRepository($this->db);
      $user = $user_repo->findBySiteAndEmail($site, $email);
      
      if (!$user) {
        $user = new \Linkamelo\Entity\ReferralUser($email);
        $user->setSiteUrl($site);
        $user_repo->save($user);
      }
      
      return 'http://'.$site.'/user/register/'.$user->getReferralCode();
  }
  
  /**
   * Registra il fatto che l'utente $email che si è registrato sul sito $site
   * ci è arrivato tramite il referral $referral
   * 
   * @param string $site     URL del sito
   * @param string $email    L'email con il quale l'utente è registrato sul sito
   * @param string $referral Il codice con il quale l'utente è arrivato sul sito
   * 
   * @return null
   * 
   */
  public function addReferral($site, $email, $referral)
  {
      $user_repo = new \Linkamelo\Repository\ReferralUserRepository($this->db);
      $user = $user_repo->findBySiteAndEmail($site, $email);
      
      $user_ref = $user_repo->findByReferral($referral);
      
      $user->referredBy($user_ref);
      
      $user_repo->save($user);
      
      return $user_ref;
  }
}

?>
