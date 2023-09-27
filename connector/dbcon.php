<?php

require '../vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount(__DIR__ . '/connector.json')
    ->withDatabaseUri('https://quiz-2a8c2-default-rtdb.firebaseio.com');

$database = $factory->createDatabase();
