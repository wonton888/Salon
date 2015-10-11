<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Client.php';

    $server = 'mysql:host=localhost; dbname=salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();

        }
        function test_getId()
        {
            $id = 1;
            $client_name = "Client A";
            $stylist_id = 2;
            $test_client = new Client ($id, $client_name, $stylist_id);
            $test_client->save();

            $result = $test_client->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getName()
        {
            $id = 1;
            $client_name = "Client A";
            $stylist_id = 2;
            $test_client = new Client ($id, $client_name, $stylist_id);
            $test_client->save();

            $result = $test_client->getName();

            $this->assertEquals("Client A", $result);
        }

        function test_save()
        {
            $id = null;
            $client_name = "Client A";
            $stylist_id = 1;
            $test_client = new Client ($id, $client_name, $stylist_id);
            $test_client->save();

            $result= Client::getAll();

            $this->assertEquals([$test_client], $result);
        }

        function test_getAll()
        {
            $id = 1;
            $client_name = "Client A";
            $stylist_id = 2;
            $test_client = new Client ($id, $client_name, $stylist_id);
            $test_client->save();

            $client_name2 = "Client B";
            $stylist_id2 = 3;
            $test_client2 = new Client ($id, $client_name2, $stylist_id);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            $id = 1;
            $client_name = "Client A";
            $stylist_id = 2;
            $test_client = new Client ($id, $client_name, $stylist_id);
            $test_client->save();

            $client_name2 = "Client B";
            $stylist_id2 = 3;
            $test_client2 = new Client ($id, $client_name2, $stylist_id);
            $test_client2->save();

            Client::deleteAll();

            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $id = 1;
            $client_name = "Client A";
            $stylist_id = 2;
            $test_client = new Client ($id, $client_name, $stylist_id);
            $test_client->save();

            $client_name2 = "Client B";
            $stylist_id2 = 3;
            $test_client2 = new Client ($id, $client_name2, $stylist_id);
            $test_client2->save();

            $result = Client::find($test_client->getId());

            $this->assertEquals($test_client, $result);

        }

    }

 ?>
