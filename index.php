<?php

require_once(__DIR__ . '/bootstrap.php');


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/src/views');
$twig = new \Twig\Environment($loader);


require_once(__DIR__ . '/router.php');




