<?php

require('../../lib/geo_xyz_conversions.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);

$x=$_GET["x"];
$y=$_GET["y"];
$z=$_GET["z"];
$a=$_GET["a"];
$b=$_GET["b"];

$latitude = .0;
$longitude = .0;
$height = .0;

$err = xyz_to_geographic($x, $y, $z, $a, $b, $latitude, $longitude, $height);

$response->payload->latitude = round(rad2deg($latitude),8);
$response->payload->longitude = round(rad2deg($longitude),8);
$response->payload->height = round($height,3);
$response->error = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));