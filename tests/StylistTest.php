<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';
    // require_once 'src/Client.php';

    $server = 'mysql:host=localhost; dbname=salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            // Client::deleteAll();
        }
        function test_getName()
        {
            $id  = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();

            $result = $test_stylist->getName();

            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            $id = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();
            $new_name = "Stylist B";

            $test_stylist->setName($new_name);
            $result = $test_stylist->getName();

            $this->assertEquals($new_name, $result);
        }

        function test_save()
        {
            $id = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);

            $test_stylist->save();

            $result = Stylist::getAll();
            $this->assertEquals($test_stylist, $result[0]);

        }

        function test_getAll()
        {
            $id = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();

            $name2 = "Stylist B";
            $test_stylist2 = new Stylist($id, $name2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            $id = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();

            $name2 = "Stylist B";
            $test_stylist2 = new Stylist($id, $name2);
            $test_stylist2->save();

            Stylist::deleteAll();

            $result = Stylist::getAll();
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            $id = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();

            $name2 = "Stylist B";
            $test_stylist2 = new Stylist($id, $name);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals($test_stylist, $result);
        }

        function test_update()
        {
            $id = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();

            $new_name = "Stylist X";

            $test_stylist->update($new_name);

            $result = $test_stylist->getName();
            $this->assertEquals($new_name, $result);
        }

        function test_delete()
        {
            $id = null;
            $name = "Stylist A";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();

            $name2 = "Stylist B";
            $test_stylist2 = new Stylist($id, $name2);
            $test_stylist2->save();

            $test_stylist->delete();

            $result = Stylist::getAll();
            $this->assertEquals([$test_stylist2], $result);

        }

    }




 ?>
