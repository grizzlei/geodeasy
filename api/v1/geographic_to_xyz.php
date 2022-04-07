<?php

require('../../lib/geo_xyz_conversions.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);

$lat=$_GET["latitude"];
$lng=$_GET["longitude"];
$ht=$_GET["height"];
$a=$_GET["a"];
$b=$_GET["b"];

$x = .0;
$y = .0;
$z = .0;

$err = geographic_to_xyz(deg2rad($lat), deg2rad($lng), $ht, $a, $b, $x, $y, $z);

$response->payload->x = round($x, 3);
$response->payload->y = round($y, 3);
$response->payload->z = round($z, 3);
$response->error->code = $err;
$response->error->what = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));