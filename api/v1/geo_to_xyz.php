<?php

require('../../lib/geo_xyz_conversions.php');
header('Content-type: application/json');

$lat=$_GET["latitude"];
$lng=$_GET["longitude"];
$ht=$_GET["height"];
$a=$_GET["a"];
$b=$_GET["b"];

$x = .0;
$y = .0;
$z = .0;

geodetic_to_xyz(deg2rad($lat), deg2rad($lng), $ht, $a, $b, $x, $y, $z);

$response->ecef->x = $x;
$response->ecef->y = $y;
$response->ecef->z = $z;

print(json_encode($response, JSON_PRETTY_PRINT));