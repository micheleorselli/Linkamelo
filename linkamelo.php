<?php 

require_once __DIR__.'/silex.phar';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

// --- BootStrap ---
$app->register(new Silex\Extension\DoctrineExtension(), array(
    'db.options' => array(
        'driver'    => 'pdo_sqlite',
        'path'      => __DIR__.'data/linkamelo.sqlite',
    ),
    'db.dbal.class_path'    => __DIR__.'/vendor/doctrine-dbal/lib',
    'db.common.class_path'  => __DIR__.'/vendor/doctrine-common/lib',
));

$app['autoloader']->registerNamespace('Linkamelo', __DIR__);


// -- Api --
$app->get('/api/{site}/{email}/referral_link', function ($site, $email) use ($app) {
    
    $service = new \Linkamelo\Service\ReferralService($app['db']);
    $link = $service->generateReferralLink($site, $email);
    
    $response = json_encode('Condividi abbestia questo link '.$app->escape($link).' !!!');
    
    return new Response($response, 200, array('Content-Type' => 'application/json'));
});

$app->get('/api/{site}/{email}/referred_by/{referral}', function ($site, $email, $referral) use ($app) {
    
    $service = new \Linkamelo\Service\ReferralService($app['db']);
    $user_ref = $service->addReferral($site, $email, $referral);
    
    $response = json_encode("Bravo $email! adesso quando condividi fai guadagnare {$user_ref->getEmail()}!!!");
    
    return new Response($response, 200, array('Content-Type' => 'application/json'));
});

$app->get('/api/{site}/{email}/objective/{objective}', function ($site, $email, $objective) use ($app) {
    
    $service = new \Linkamelo\Service\ReferralService($app['db']);
    $user_referral = $service->userReachObjective($site, $email, $objective);
    
    $response = json_encode("Bravo $email! Raggiungendo l'obiettivo $objective hai fatto guadagnare punti a {$user_referral->getEmail()} !!!");
    
    return new Response($response, 200, array('Content-Type' => 'application/json'));
});


return $app;

//$app['dispatcher']->addListener('mio.evento', function(){ echo 'mioooooooooo';});
//$app['dispatcher']->dispatch('mio.evento');
