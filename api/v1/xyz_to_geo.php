<?php

require('../../lib/geo_xyz_conversions.php');
header('Content-type: application/json');

$x=$_GET["x"];
$y=$_GET["y"];
$z=$_GET["z"];
$a=$_GET["a"];
$b=$_GET["b"];

$latitude = .0;
$longitude = .0;
$height = .0;

xyz_to_geodetic($x, $y, $z, $a, $b, $latitude, $longitude, $height);

$response->geographic->latitude = (float)number_format(rad2deg($latitude),8);
$response->geographic->longitude = (float)number_format(rad2deg($longitude),8);
$response->geographic->height = (float)number_format($height,2);

print(json_encode($response, JSON_PRETTY_PRINT));