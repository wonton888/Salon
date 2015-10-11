<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost; db=salon_test';
    $username = 'root';
    $password =  'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
        }

        function test_getName()
        {
            //arrange
            $name = "Stylist A";
            $test_stylist = new Stylist($name);

            //act
            $result = $test_stylist->getName();

            //assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //arrange
            $name = "Stylist A";
            $id = 1;
            $test_stylist = new Stylist($name, $id);

            //act
            $result = $test_stylist->getId();

            //assert
            $this->assertEquals(true, is_numeric($result));

        }

        function test_save()
        {
            //arrange
            $name = "Stylist A";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);

        }

        function test_getAll()
        {
            $name = "Stylist A";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Stylist B";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist, $test_stylist2], $result);

        }

        function test_deleteAll()
        {
            $name = "Stylist A";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Stylist B";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            Stylist::deleteAll();
            $result = Stylist::getAll();

            $this->assertEquals([], $result);

        }



    }






 ?>


 ?>
