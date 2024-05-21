<?php

$api_url = 'https://cat-fact.herokuapp.com/facts/random';

$response = file_get_contents($api_url);

$fact = json_decode($response, false);

if ($fact && isset($fact->text)) {
    echo 'Random Cat Fact: ' . $fact->text . PHP_EOL;
} else {
    echo 'Failed to retrieve cat fact. Please try again later.' . PHP_EOL;
}