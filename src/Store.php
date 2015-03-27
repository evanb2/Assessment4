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

  


  }
?>
