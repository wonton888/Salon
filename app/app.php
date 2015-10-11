<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";
    // use Symfony\Component\HttpFoundation\Request;
    // Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;db=salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path'=>__DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array( 'stylists' => Stylist::getAll()));
    });

    $app->post("/", function() use ($app){
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array( 'stylists' => Stylist::getAll()));
    });

    $app->post("/delete", function() use ($app){
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array ('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists/{id}", function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    //update stylists
    $app->patch("/stylists/{id}", function($id) use ($app){
        $new_name = $_POST['new_name'];
        $stylist = Stylist::find($id);
        $stylist->update($new_name);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients'=> $stylist->getClients()));
    });

    //delete stylists

    $app->delete("/stylists/{id}", function($id) use ($app){
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/clients", function() use ($app){
        $name = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];
        $new_client = new Client($name, $id = null, $stylist_id);
        return $app['twig']->render('stylists.html.twig', array('stylist'=> $stylist, 'clients' =>$stylist->getClients()));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app){
        $stylist = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array('stylist' => $stylist));
    });

    //update clients
    $app->patch("/stylists/{id}", function($id) use ($app){
        $new_name = $_POST['new_client'];
        $client = Client::find($id);
        $client->update($new_name);
        return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

    //delete client

    $app->delete("/client/{id}", function($id) use ($app){
        $client = Client::find($id);
        $client->delete();
        return $app['twig']->render('client_edit.html.twig', array('client' =>$client));
    });

    return $app;






 ?>
