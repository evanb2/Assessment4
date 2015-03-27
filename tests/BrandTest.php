<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    class BrandTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
      {
        Brand::deleteAll();
        Store::deleteAll();
      }

      function test_getBrandname()
      {
        //Arrange
        $brandname = "Nike";
        $id = 1;
        $test_brand = new Brand($brandname, $id);

        //Act
        $result = $test_brand->getBrandname();

        //Assert
        $this->assertEquals($brandname, $result);
      }

      function test_getId()
      {
        //Arrange
        $brandname = "Nike";
        $id = 1;
        $test_brand = new Brand($brandname, $id);

        //Act
        $result = $test_brand->getId();

        //Assert
        $this->assertEquals(1, $result);
      }
    }
?>
