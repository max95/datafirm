<?php

// Address
$address = $_GET['adresse'];
echo $adress;

// Address from command line
// $address = readline("Enter an address: ");
// $address = str_replace(' ','+',$address);

// Get JSON results from this request
// This url works
$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

// This url creates an error
//$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'+&sensor=false+CA&key=[MyAPIKeyHere]');

// Convert the JSON to an array
$geo = json_decode($geo, true);

if ($geo['status'] == 'OK') {
  // Get Lat & Long
  $latitude = $geo['results'][0]['geometry']['location']['lat'];
  $longitude = $geo['results'][0]['geometry']['location']['lng'];
}

// $address = str_replace('+',' ',$address);
echo $latitude. ", ". $longitude;

?>
