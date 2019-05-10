<?php

require_once('bootstrap.php');


$loader = new \Twig\Loader\FilesystemLoader('./src/views');
$twig = new \Twig\Environment($loader);


require_once('router.php');



