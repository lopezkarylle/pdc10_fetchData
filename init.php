<?php

include "vendor/autoload.php";
include "config/database.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Models\Connection;
use Models\Class;
use Models\Teacher;
use Models\Student;

$connObj = new Connection($host, $database, $user, $password, $server);
$connection = $connObj->connect();

$mustache = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
]);

?>