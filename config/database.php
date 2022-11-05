<?php

use Dotenv\Dotenv as Env;

$env = Env::createImmutable(__DIR__ . '/../'); // move up
$env->load();

$host = $_ENV['localhost:27017'];
$database = $_ENV['local'];
$user = $_ENV['MDB_USER'];
$password = $_ENV['MDB_PASS'];
$server = $_ENV['ATLAS_CLUSTER_SRV'];
?>