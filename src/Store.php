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
    $GLOBALS['DB']->exec("DELETE FROM stores_brands *;");
  }


  }
?>
