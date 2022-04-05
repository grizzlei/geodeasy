<?php

require('../../lib/error.php');
require('../../lib/geo_xyz_conversions.php');
header('Content-type: application/json');

ini_set('serialize_precision', 8);

$lat=$_GET["latitude"];
$lng=$_GET["longitude"];
$ht=$_GET["height"];
$a=$_GET["a"];
$b=$_GET["b"];

$x = .0;
$y = .0;
$z = .0;

$err = geographic_to_xyz(deg2rad($lat), deg2rad($lng), $ht, $a, $b, $x, $y, $z);

$response->payload->x = round($x,8);
$response->payload->y = round($y,8);
$response->payload->z = round($z,8);

$response->error =  geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));