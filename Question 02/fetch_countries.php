<?php
// API URL to fetch countries
$url = "https://restcountries.com/v3.1/all?fields=name";
$response = file_get_contents($url);
$countries = json_decode($response, true);

$options = '';
foreach ($countries as $country) {
    $name = $country['name']['common'];
    $options .= "<option value='{$name}'>{$name}</option>";
}
echo $options;

?>