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
        function test_getId()
        {
            $name = "Stylist A";
            $id = 1;
            $test_stylist = new Stylist($name, $id);


            $result = $test_stylist->getId();

            $this->assertEquals(1, $result);

        }

        function test_setId()
        {
            $name = "Stylist A";
            $id = 1;
            $test_stylist = new Stylist ($name, $id);

            $test_stylist->setId(2);
            $result = $test_stylist->getId();

            $this->assertEquals(2, $result);

        }

        function test_save()
        {
            $name = "Stylist A";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);

        }


    }






 ?>
