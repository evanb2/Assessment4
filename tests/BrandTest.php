<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $DB = new PDO('pgsql:host=localhost;dbname=shoes_test');

    Class BrandTest extends PHPUnit_Framework_TestCase
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

        function test_setBrandname()
        {
            //Arrange
            $brandname = "Nike";
            $id = 1;
            $test_brand = new Brand($brandname, $id);

            //Act
            $test_brand->setBrandname("Adidas");
            $result = $test_brand->getBrandname();

            //Assert
            $this->assertEquals("Adidas", $result);
        }

        function test_setId()
        {
            //Arrange
            $brandname = "Nike";
            $id = 1;
            $test_brand = new Brand($brandname, $id);

            //Act
            $test_brand->setId(2);
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_save()
        {
            //Arrange
            $brandname = "Nike";
            $id = 1;
            $test_brand = new Brand($brandname, $id);

            //Act
            $test_brand->save();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $brandname = "Nike";
            $id = 1;
            $test_brand = new Brand($brandname, $id);
            $test_brand->save();

            $brandname2 = "Adidas";
            $id2 = 2;
            $test_brand2 = new Brand($brandname2, $id2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $brandname = "Nike";
            $id = 1;
            $test_brand = new Brand($brandname, $id);
            $test_brand->save();

            $brandname2 = "Adidas";
            $id2 = 2;
            $test_brand2 = new Brand($brandname2, $id2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $brandname = "Nike";
            $id = 1;
            $test_brand = new Brand($brandname, $id);
            $test_brand->save();

            $brandname2 = "Adidas";
            $id2 = 2;
            $test_brand2 = new Brand($brandname2, $id2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());

            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function test_getStores()
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

            $brandname = "Nike";
            $id3 = 3;
            $test_brand = new Brand($brandname, $id3);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
        }

        function test_addStore()
        {
            //Arrange
            $storename = "Redwing Shoes";
            $id = 1;
            $test_store = new Store($storename, $id);
            $test_store->save();

            $brandname = "Nike";
            $id2 = 2;
            $test_brand = new Brand($brandname, $id2);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }
    }
?>
