<?php
  Class Brand
  {
    private $brandname;
    private $id;

    function __construct($brandname, $id = null)
    {
      $this->brandname = $brandname;
      $this->id = $id;
    }

    //setters
    function setBrandname($new_brandname)
    {
      $this->brandname = (string) $new_brandname;
    }

    function setId($new_id)
    {
      $this->id = (int) $new_id;
    }

    //getters
    function getBrandname()
    {
      return $this->brandname;
    }

    function getId()
    {
      return $this->id;
    }

    function save()
    {
      $statement = $GLOBALS['DB']->query("INSERT INTO brands (brandname) VALUES ('{$this->getBrandname()}') RETURNING id;");
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      $this->setId($result['id']);
    }

    function addStore($store)
    {
      $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
    }

    function getStores()
    {
      $query = $GLOBALS['DB']->query("SELECT store_id FROM stores_brands WHERE brand_id = {$this->getId()};");
      $store_ids = $query->fetchAll(PDO::FETCH_ASSOC);

      $stores = array();
      foreach($store_ids as $id) {
        $store_id = $id['store_id'];
        $result = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$store_id};");
        $returned_store = $result->fetchAll(PDO::FETCH_ASSOC);

        $storename = $returned_store[0]['storename'];
        $id = $returned_store[0]['id'];
        $new_store = new Store($storename, $id);
        array_push($stores, $new_store);
      }
      return $stores;
    }
    //static functions
    static function getAll()
    {
      $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
      $brands = array();
      foreach($returned_brands as $brand) {
        $brandname = $brand['brandname'];
        $id = $brand['id'];
        $new_brand = new Brand($brandname, $id);
        array_push($brands, $new_brand);
      }
      return $brands;
    }

    static function find($search_id)
    {
      $found_brand = null;
      $brands = Brand::getAll();
      foreach($brands as $brand) {
        $brand_id = $brand->getId();
        if ($brand_id == $search_id) {
          $found_brand = $brand;
        }
      }
      return $found_brand;
    }

    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM brands *;");
    }
  }
?>
