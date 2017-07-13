<?php
require_once './vendor/twig/lib/Twig/Autoloader.php';
require './controller/siteController.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('./views');
$twig = new Twig_Environment($loader);

$twig = new Twig_Environment($loader, array(
    'cache' => false,
    'debug' => true,
));
$twig->addExtension(new Twig_Extension_Debug());

$siteController = new SiteController();

echo $twig->render('items.twig', array(
  'title'         => 'Items',
  'ItemActivo' => 'active',
  'items' => $siteController->getItems()
));
