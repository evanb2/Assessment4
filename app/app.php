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
  $app->get("/stores", function() use ($app) {
    return $app['twig']->render('stores.twig', array('stores' => Store::getAll()));
  });

  //READ all brands
  $app->get("/brands", function() use ($app) {
    return $app['twig']->render('brands.twig', array('brands' => Brand::getAll()));
  });

  //READ singular store
  $app->get("/stores/{id}", function($id) use ($app) {
    $store = Store::find($id);
    return $app['twig']->render('store.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  //READ singular brand
  $app->get("/brands/{id}", function($id) use ($app) {
    $brand = Brand::find($id);
    return $app['twig']->render('brand.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
  });

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
