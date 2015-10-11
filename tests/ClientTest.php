<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once 'src/Stylist.php';
    require_once 'src/Client.php';

    $server = 'mysql:host=localhost; dbname=salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_save()
        {
            $id = null;
            $name = "Client A";
            $stylist_id = 1;
            $test_client = new Client ($id, $name, $stylist_id);

            $test_client->save();

            $result = Client::getAll();
            $this->assertEquals([$test_client], $result);
        }

        function test_getAll()
        {
            $id = null;
            $name = "Client A";
            $stylist_id = 1;
            $test_client = new Client ($id, $name, $stylist_id);
            $test_client->save();

            $name2 = "Client B";
            $stylist_id2 = 2;
            $test_client2 = new Client ($id, $name2, $stylist_id2);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            $id = null;
            $name = "Client A";
            $stylist_id = 1;
            $test_client = new Client ($id, $name, $stylist_id);
            $test_client->save();

            $name2 = "Client B";
            $stylist_id = 2;
            $test_client = new Client ($id, $name2, $stylist_id);
            $test_client->save();

            Client::deleteAll();

            $result = Client::getAll();
            $this->assertEquals([], $result);

        }

    }
 ?>
