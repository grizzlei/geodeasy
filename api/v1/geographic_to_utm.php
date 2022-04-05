<?php

require('../../lib/error.php');
require('../../lib/geo_tm_conversions.php');
header('Content-type: application/json');

ini_set('serialize_precision', 8);

$lat=$_GET["latitude"];
$lng=$_GET["longitude"];

$a=6378137.0;
$b=6356752.314245;
$a=$_GET["a"];
$b=$_GET["b"];

$easting = .0;
$northing = .0;

$lat0 = 0.0;
$utm_zone = ceil(($lng + 180.0) / 6);
$lng0 = $utm_zone * 6 - 3 - 180; 
$E0 = 500000;
$N0 = $lng < 0 ? 10000000 : 0;
$k0 = 0.9996;

$err = geographic_to_transverse_mercator(deg2rad($lat), deg2rad($lng), deg2rad($lat0), deg2rad($lng0), $E0, $N0, $k0, $a, $b, $easting, $northing);

$response->payload->easting = round($easting, 8);
$response->payload->northing = round($northing, 8);
$response->payload->utm_zone = $utm_zone;
$response->payload->hemisphere = $lat > 0 ? 'Northern' : 'Southern';
$response->error = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));