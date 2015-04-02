<?php
  Class Store
  {
    private $storename;
    private $id;

  function __construct($storename, $id = null)
  {
    $this->storename = $storename;
    $this->id = $id;
  }
  //setters
  function setStorename($new_storename)
  {
    $this->storename = (string) $new_storename;
  }

  function setId($new_id)
  {
    $this->id = (int) $new_id;
  }
  //getters
  function getStorename()
  {
    return $this->storename;
  }

  function getId()
  {
    return $this->id;
  }

  function save()
  {
    $statement = $GLOBALS['DB']->query("INSERT INTO stores (storename) VALUES ('{$this->getStorename()}') RETURNING id;");
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $this->setId($result['id']);
  }

  function update($new_storename)
  {
    $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_storename}' WHERE id = {$this->getId()};");
    $this->setStorename($new_storename);
  }

  function delete()
  {
    $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
    $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
  }

  function addBrand($brand)
  {
      $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
  }

  function getBrands()
  {
    $statement = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                JOIN brands_stores ON (stores.id = brands_stores.store_id)
                JOIN brands ON (brands_stores.brand_id = brands.id)
                WHERE stores.id = {$this->getId()};");
    $brand_ids = $statement->fetchAll(PDO::FETCH_ASSOC);
    $brands = array();
    foreach ($brand_ids as $brand) {
        $brandname = $brand['brandname'];
        $id = $brand['id'];
        $new_brand = new Brand($brandname, $id);
        array_push($brands, $new_brand);
    }
    return $brands;
  }

  //static functions
  static function getAll()
  {
    $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
    $stores = array();
    foreach($returned_stores as $store) {
      $storename = $store['storename'];
      $id = $store['id'];
      $new_store = new Store($storename, $id);
      array_push($stores, $new_store);
    }
    return $stores;
  }

  static function find($search_id)
  {
    $found_store = null;
    $stores = Store::getAll();
    foreach($stores as $store) {
      $store_id = $store->getId();
      if ($store_id == $search_id) {
        $found_store = $store;
      }
    }
    return $found_store;
  }

  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM stores *;");
    $GLOBALS['DB']->exec("DELETE FROM brands_stores *;");
  }


  }
?>
