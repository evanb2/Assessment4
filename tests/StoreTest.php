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
      protected function tearDown()
      {
        Store::deleteAll();
        Brand::deleteAll();
      }

      function test_getStorename()
      {
        //Arrange
        $storename = "Redwing Shoes";
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
        $storename = "Redwing Shoes";
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
        $storename = "Redwing Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);

        //Act
        $test_store->setId(2);
        $result = $test_store->getId();

        //Assert
        $this->assertEquals(2, $result);
      }

      function test_save()
      {
        //Arrange
        $storename = "Redwing Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);
        $test_store->save();

        //Act
        $result = Store::getAll();

        //Assert
        $this->assertEquals($test_store, $result[0]);
      }

      function test_getAll()
      {
        //Arrange
        $storename = "Redwing Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);
        $test_store->save();

        $storename2 = "Danner";
        $id2 = 2;
        $test_store2 = new Store($storename2, $id2);
        $test_store2->save();

        //Act
        $result = Store::getAll();

        //Assert
        $this->assertEquals([$test_store, $test_store2], $result);
      }

      function test_deleteAll()
      {
        //Arrange
        $storename = "Redwing Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);
        $test_store->save();

        $storename2 = "Danner";
        $id2 = 2;
        $test_store2 = new Store($storename2, $id2);
        $test_store2->save();

        //Act
        Store::deleteAll();
        $result = Store::getAll();

        //Assert
        $this->assertEquals([], $result);
      }

      function test_find()
      {
        //Arrange
        $storename = "Redwing Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);
        $test_store->save();

        $storename2 = "Danner";
        $id2 = 2;
        $test_store2 = new Store($storename2, $id2);
        $test_store2->save();

        //Act
        $result = Store::find($test_store->getId());

        //Assert
        $this->assertEquals($test_store, $result);
      }

      function test_update()
      {
        //Arrange
        $storename = "Redwing Shoes";
        $id = 1;
        $test_store = new Store($storename, $id);
        $test_store->save();

        $new_storename = "Timberland";

        //Act
        $test_store->update($new_storename);

        //Assert
        $this->assertEquals($new_storename, $test_store->getStorename());
      }

      // function test_delete()
      // {
      //   //Arrange
      //   $storename = "Redwing Shoes";
      //   $id = 1;
      //   $test_store = new Store($storename, $id);
      //   $test_store->save();
      //
      //   $brandname =
      // }
    }
?>
