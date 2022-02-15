<?php 

session_start();

//path
$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];

//uklanjamo index.php iz putanje
$path = str_replace("index.php", "", $path);

//Definisali smo root i sada root je naš path
define('ROOT', $path);

//definisali smo folder
define('ASSETS', $path . "assets/");

include "../app/init.php";

$app = new App();
