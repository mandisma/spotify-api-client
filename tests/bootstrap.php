<?php

require __DIR__ . '/../vendor/autoload.php';

function load_fixture($fixture)
{
    $fixture = __DIR__ . '/fixtures/' . $fixture . '.json';
    return file_get_contents($fixture);
}
