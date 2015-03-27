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
  $app->get("/stores/{id}/edit", function($id) use ($app) {
    $store = Store::find($id);
    return $app['twig']->render('store_edit.twig', array('store' => $store));
  });

  //CREATE store
  $app->post("/stores", function() use ($app) {
    $storename = $_POST['storename'];
    $store = new Store($storename);
    $store->save();
    return $app['twig']->render('stores.twig', array('stores' => Store::getAll()));
  });

  //CREATE brand
  $app->post("/brands", function() use ($app) {
    $brandname = $_POST['brandname'];
    $brand = new Brand($brandname);
    $brand->save();
    return $app['twig']->render('brands.twig', array('brands' => Brand::getAll()));
  });

  //CREATE add stores to brands
  $app->post("/add_stores", function() use ($app) {
    $store = Store::find($_POST['store_id']);
    $brand = Brand::find($_POST['brand_id']);
    $brand->addStore($store);
    return $app['twig']->render('brand.twig', array('brand' => $brand, 'brands' => Brand::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
  });

  //CREATE add brands to stores
  $app->post("/add_brands", function() use ($app) {
    $store = Store::find($_POST['store_id']);
    $brand = Brand::find($_POST['brand_id']);
    $store->addBrand($brand);
    return $app['twig']->render('store.twig', array('store' => $store, 'stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  //DELETE all stores
  $app->post("/delete_stores", function() use ($app) {
    Store::deleteAll();
    return $app['twig']->render('index.twig');
  });

  //DELETE singular store
  $app->delete("/stores/{id}", function($id) use ($app) {
    $store = Store::find($id);
    $store->delete();
    return $app['twig']->render('index.twig', array('stores' => Store::getAll()));
  });

  //PATCH routes
  $app->patch("/stores/{id}", function($id) use ($app) {
    $storename = $_POST['storename'];
    $store = Store::find($id);
    $store->update($storename);
    return $app['twig']->render('stores.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
  });

  return $app;
?>
