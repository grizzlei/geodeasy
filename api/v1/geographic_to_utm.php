<?php

require('../../lib/geo_tm_conversions.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);

$lat=$_GET["latitude"];
$lng=$_GET["longitude"];
$a=$_GET["a"];
$b=$_GET["b"];

$easting = .0;
$northing = .0;

$lat0 = 0.0;
$utm_zone = ceil(($lng + 180.0) / 6);
$lng0 = $utm_zone * 6 - 3 - 180; 
$E0 = GDS_TRANMERC_FALSE_EASTING;
$N0 = $lat < 0 ? GDS_TRANMERC_FALSE_NORTHING : 0;
$k0 = GDS_UTM_SCALE_FACTOR;

$err = geographic_to_transverse_mercator(deg2rad($lat), deg2rad($lng), deg2rad($lat0), deg2rad($lng0), $E0, $N0, $k0, $a, $b, $easting, $northing);

$response->payload->easting = round($easting,3);
$response->payload->northing = round($northing,3);
$response->payload->utm_zone = $utm_zone;
$response->payload->hemisphere = $lat > 0 ? 'Northern' : 'Southern';
$response->error->code = $err;
$response->error->what = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));