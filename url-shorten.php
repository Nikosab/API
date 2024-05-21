<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

function shortenUrl($url) {
    $client = new Client();
    $api_url = 'https://cleanuri.com/api/v1/shorten';

    try {
        $response = $client->request('POST', $api_url, [
            'form_params' => [
                'url' => $url
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return $data['result_url'];
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage() . PHP_EOL;
    }

    return false;
}

echo "Enter the long URL: ";
$long_url = trim(fgets(STDIN));

$short_url = shortenUrl($long_url);

if ($short_url) {
    echo "Short URL: $short_url" . PHP_EOL;
} else {
    echo "Failed to shorten the URL." . PHP_EOL;
}