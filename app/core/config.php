<?php

//title
define("WEBSITE_NAME", 'MY SHOP');

//database name

//kada prikazemo na lokalni server stranicu nećemo moči mijenjati podatke tako da uz pomoć ove petlje je sve u redu
if($_SERVER['SERVER_NAME'] == "localhost")
{

    define('DB_NAME', "eshob_dbbb");
    define('DB_USER', "root");
    define('DB_PASS', "");
    define('DB_TYPE', "mysql");
    define('DB_HOST', "localhost");

}else{

    define('DB_NAME', "id17953216_eshop_dbbb");
    define('DB_USER', "id17953216_root");
    define('DB_PASS', "");
    define('DB_TYPE', "mysql");
    define('DB_HOST', "localhost");
}

$url = 'http://' . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] . str_replace("index.php", "", $_SERVER['PHP_SELF']) . str_replace('url=', "", $_SERVER['QUERY_STRING']);


$url = 'http://' . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] . str_replace("index.php", "", $_SERVER['PHP_SELF']) . str_replace('url=', "", $_SERVER['QUERY_STRING']);


define('FULL_URL',$url);

define('THEME', 'eshop/');

define('DEBUG', true);

//otklanjanje grešaka radi i ne radi
if(DEBUG){

    ini_set('display_errors', 1);

}else{

    ini_set('display_errors', 0);

}

?>