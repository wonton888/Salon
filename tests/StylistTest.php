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
            // Stylist::deleteAll();
        }

        function test_getId()
        {
            $name = "Stylist A";
            $id = 1;
            $test_stylist = new Stylist($name, $id);


            $result = $test_stylist->getId();

            $this->assertEquals(1, $result);

        }

        function test_save()
        {
            $name = "Stylist A";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
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

        // function test_deleteAll()
        // {
        //     $name = "Stylist A";
        //     $id = 1;
        //     $test_stylist = new Stylist($name, $id);
        //     $test_stylist->save();
        //
        //     $name2 = "Stylist B";
        //     $id2 = 2;
        //     $test_stylist2 = new Stylist($name2, $id2);
        //     $test_stylist2->save();
        //
        //     Stylist::deleteAll();
        //     $result = Stylist::getAll();
        //
        //     $this->assertEquals([], $result);
        //
        // }



    }






 ?>
