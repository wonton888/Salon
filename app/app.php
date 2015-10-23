<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";
    // use Symfony\Component\HttpFoundation\Request;
    // Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path'=>__DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function () use ($app){
      return $app['twig']->render('index.html.twig', array('stylists'=> Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app){
      $stylist = new Stylist ($_POST['name']);
      $stylist->save();
      return $app['twig']->render ('index.html.twig', array('stylists'=> Stylist::getAll()));
    });

    $app->post("delete_stylists", function() use ($app){
      Stylist::deleteAll();
      return $app['twig']->render('index.html.twig', array('stylists'=> Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app){
      $stylist = Stylist::find($id);
      return $app['twig']->render('stylist.html.twig', array('stylist'=> $stylist, 'clients'=>$stylist->getClients()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app){
      $stylist = Stylist::find($id);
      return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->patch ("/stylists/{id}/update", function($id) use ($app){
      $stylist = Stylist::find($id);
      $name = $_POST['name'];
      $stylist->update($name);
      return $app['twig']->render('stylist.html.twig', array('stylist'=> $stylist, 'clients'=>$stylist->getClients()));
    });

    $app->delete("/stylists/{id}/delete", function($id) use ($app){
      $stylist = Stylist::find($id);
      $stylist->delete();
      return $app['twig']->render('index.html.twig', array('stylists'=> Stylist::getAll()));
    });

    $app->post("/stylists/{id}/add_client", function($id) use ($app){
      $stylist_id = $_POST['stylist_id'];
      $stylist = Stylist::find($id);
      $client = new Client($id = null, $_POST['client_name'], $stylist_id);
      $client->save();
      $client_name = $_POST['client_name'];
      return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients'=>$stylist->getClients()));
    });

    $app->get("/client/{id}/edit", function($id) use ($app){
      $client = Client::find($id);
      return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

    $app->patch("/client/{id}/update", function($id) use ($app){
      $new_name = $_POST['client_name'];
      $client_update = Client::find($id);
      $client_update->update($new_name);
      $stylist = Stylist::find($client_update->getStylistId());
      var_dump($client_update);
      return $app['twig']->render('stylist.html.twig', array('stylist'=>$stylist, 'clients'=>$stylist->getClients()));
    });
    $app->delete("/client/{id}/delete", function($id) use ($app){
      $client = Client::find($id);
      $stylist = Stylist::find($client->getStylistId());
      $client->delete();
      return $app['twig']->render('stylist.html.twig', array('stylist'=> $stylist, 'clients'=> $stylist->getClients()));
    });

    $app->post("/delete_clients", function() use ($app){
      Client::deleteAll();
      return $app['twig']->render('index.html.twig', array('stylists'=>Stylist::getAll()));
    });

    return $app;






 ?>
