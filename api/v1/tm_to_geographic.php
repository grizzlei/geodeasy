<?php

require('../../lib/geo_tm_conversions.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);

$a=$_GET["a"] ?? GDS_WGS84_SEMI_MAJOR;
$b=$_GET["b"] ?? GDS_WGS84_SEMI_MINOR;
$easting=$_GET["easting"];
$northing=$_GET["northing"];
$hemisphere=$_GET["hemisphere"];
$lat0 = $_GET["lat0"];
$lon0 = $_GET["lon0"]; 
$k0 = $_GET["k0"] ?? GDS_TM_SCALE_FACTOR;
$E0 = GDS_TM_FALSE_EASTING;
$N0 = 0.;

if($hemisphere == 'N')
    $false_northing = 0;
else if($hemisphere == 'S')
    $false_northing = GDS_TM_FALSE_NORTHING;

$err = transverse_mercator_to_geographic($easting, $northing, deg2rad($lat0), deg2rad($lon0), $E0, $N0, $k0, $a, $b, $latitude, $longitude);

$response->payload->latitude = round(rad2deg($latitude),8);
$response->payload->longitude = round(rad2deg($longitude),8);
$response->error->code = $err;
$response->error->what = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));