<?php
class Stylist
{
     private $id;
     private $name;

     function __construct($name, $id = NULL)
     {
         $this->name = $name;
         $this->id = $id;
     }

     function getId()
     {
         return $this->id;
     }

     function getName()
     {
         return $this->name;
     }

     function setName($new_name)
     {
         $this->name = (string) $new_name;
     }
     function save()
     {
         $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
         $this->id = $GLOBALS['DB']->lastInsertId();
     }

     static function getAll()
     {
         $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists");
         $stylists = array();
         if (is_array($returned_stylists) || is_object($returned_stylists))
         {
         foreach ($returned_stylists as $stylist){
             $id = $stylist['id'];
             $name = $stylist['name'];
             $new_stylist = new Stylist($id, $name);
             array_push($stylists, $new_stylist);
         }
         return $stylists;
         }
     }

     static function deleteAll()
     {
         $GLOBALS['DB']->exec("DELETE FROM stylists");
     }

     static function find($id)
     {
         $found_stylist = null;
         $stylists = Stylist::getAll();

         foreach($stylists as $stylist){
             $stylist_id = $stylist->getId();
             if ($stylist_id == $id){
                 $found_stylist = $stylist;
             }
         }
         return $found_stylist;
     }

     function update($new_name)
     {
         $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
         $this->setName($new_name);
     }

     function delete()
     {
         $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
         $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
     }

     function getClients()
     {
         $clients = Array();
         $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
         foreach ($returned_clients as $client)
         {
            $id = $client['id'];
            $client_name = $client['client_name'];
            $stylist_id = $client['stylist_id'];
            $new_client = new Client( $id, $client_name, $stylist_id);
            array_push($clients, $new_client);
         }
         return $clients;
     }


   }


 ?>
