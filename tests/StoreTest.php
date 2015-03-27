<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class StoreTest extends PHPUnit_Framework_TestCase
    {
      // protected function tearDown()
      // {
      //   Store::deleteAll();
      //   Brand::deleteAll();
      // }

      function test_getStorename()
      {
        //Arrange
        $storename = "Really Good Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);

        //Act
        $result = $test_store->getStorename();

        //Assert
        $this->assertEquals($storename, $result);
      }

      function test_getId()
      {
        //Arrange
        $storename = "Really Good Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);

        //Act
        $result = $test_store->getId();

        //Assert
        $this->assertEquals(1, $result);
      }

      function test_setId()
      {
        //Arrange
        $storename = "Really Good Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);

        //Act
        $test_store->setId(2);
        $result = $test_store->getId();

        //Assert
        $this->assertEquals(2, $result);
      }
    }
?>
