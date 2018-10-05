<?php
use Psr\Container\ContainerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;

return [
    Faker\Factory::class => function() {
        return Faker\Factory::create();
    },
    MongoDB\Client::class => function() {
        return new MongoDB\Client('mongodb://mongodb');
    }
];