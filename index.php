<?php
include "vendor/autoload.php";

$client = new MongoDB\Client("mongodb://localhost:27017");
$mustache = new Mustache_Engine([
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
]);
$collection = $client->local->students;
$result = $collection->find();

$template = $mustache->loadTemplate('index.mustache');
echo $template->render(compact('result'));