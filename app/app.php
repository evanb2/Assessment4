<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Store.php";
  require_once __DIR__."/../src/Brand.php";

  $app = new Silex\Application();

  $DB = new PDO('pgsql:host=localhost;dbname=shoes');

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.twig');
  });
  //READ all stores

  //READ all brands

  //READ singular store

  //READ singular brand

  //store EDIT form

  //CREATE store

  //CREATE brand

  //CREATE add stores to brands

  //CREATE add brands to stores

  //DELETE all stores

  //DELETE singular store

  //PATCH routes

  return $app;
?>
