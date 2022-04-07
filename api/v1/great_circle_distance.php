<?php

require('../../lib/vincenty.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);

$lat1=$_GET["latitude1"];
$lng1=$_GET["longitude1"];
$lat2=$_GET["latitude2"];
$lng2=$_GET["longitude2"];
$a=$_GET["a"];
$b=$_GET["b"];

$azimuth = 0.;
$reverse_azimuth = 0.;
$distance = 0.;

$err = vincenty_inverse(deg2rad($lat1), deg2rad($lng1), deg2rad($lat2), deg2rad($lng2),$a, $b, $azimuth, $reverse_azimuth, $distance);

$response->payload->azimuth = round(rad2deg($azimuth),8);
$response->payload->reverse_azimuth = round(rad2deg($reverse_azimuth),8);
$response->payload->distance = round($distance, 3);
$response->error->code = $err;
$response->error->what = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));