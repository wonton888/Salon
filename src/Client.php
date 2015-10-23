<?php

    class Client
    {
        private $id;
        private $client_name;
        private $stylist_id;

        function __construct($id = null, $client_name, $stylist_id){
            $this->id = $id;
            $this->client_name = $client_name;
            $this->stylist_id = $stylist_id;
        }

        function getName()
        {
            return $this->client_name;
        }

        function setName($new_name)
        {
            $this->client_name = $new_name;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = $$new_stylist_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (client_name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()});");
            $this->id = $GLOBALS ['DB']->lastInsertId();
        }

        static function getAll(){
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach ($returned_clients as $client){
                $id = $client['id'];
                $client_name = $client['client_name'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($id, $client_name, $stylist_id);
                array_push ($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach ($clients as $client){
                $client_id = $client->getId();
                if ($client_id == $id){
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = ('{$this->getId()}');");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET client_name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }


    }
 ?>
