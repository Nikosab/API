<?php

function getApiResponse($url) {
    $response = file_get_contents($url);
    return json_decode($response, false);
}

echo "Enter a name: ";
$name = trim(fgets(STDIN));

$agify_url = 'https://api.agify.io?name=' . urlencode($name);
$genderize_url = 'https://api.genderize.io?name=' . urlencode($name);
$nationalize_url = 'https://api.nationalize.io?name=' . urlencode($name);

$age_data = getApiResponse($agify_url);
$gender_data = getApiResponse($genderize_url);
$nationality_data = getApiResponse($nationalize_url);

if (isset($age_data->age)) {
    echo "The predicted age for the name '$name' is " . $age_data->age . " years old." . PHP_EOL;
} else {
    echo "Failed to retrieve age data for the name '$name'." . PHP_EOL;
}

if (isset($gender_data->gender)) {
    $probability = $gender_data->probability * 100;
    echo "The name '$name' is " . $probability . "% likely to be " . $gender_data->gender . "." . PHP_EOL;
} else {
    echo "Failed to retrieve gender data for the name '$name'." . PHP_EOL;
}

if (isset($nationality_data->country)) {
    echo "The name '$name' is most likely from the following countries:" . PHP_EOL;
    foreach ($nationality_data->country as $country) {
        $probability = $country->probability * 100;
        echo "- " . $country->country_id . " with " . $probability . "% probability." . PHP_EOL;
    }
} else {
    echo "Failed to retrieve nationality data for the name '$name'." . PHP_EOL;
}