<?php
require_once './vendor/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('./views');
$twig = new Twig_Environment($loader);

$twig = new Twig_Environment($loader, array(
    'cache' => false,
));

echo $twig->render('home.twig', array(
  'title' => 'Inicio',
  'almacenes' => [[
    'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ],[
      'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ],[
      'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ],[
      'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ],[
      'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ],[
      'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ],[
      'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ],[
      'id' => 1,
      'nombre' => 'Nombre de Almacén',
      'items' => 1,
      'mensaje' => 'Un mensaje'
    ]]
));
