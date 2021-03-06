<?php

require('../../lib/geo_tm_conversions.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);

$a=$_GET["a"];
$b=$_GET["b"];
$easting=$_GET["easting"];
$northing=$_GET["northing"];
$utm_zone=$_GET["utm_zone"];
$hemisphere=$_GET["hemisphere"];

$latitude=.0;
$longitude=.0;
$k0 = GDS_UTM_SCALE_FACTOR;

$origin_latitude = .0;
$origin_longitude = $utm_zone * 6 - 3 - 180; 
$false_easting = GDS_TM_FALSE_EASTING;
$false_northing = 0.;

if($hemisphere == 'N')
    $false_northing = 0;
else if($hemisphere == 'S')
    $false_northing = GDS_TM_FALSE_NORTHING;

$err = transverse_mercator_to_geographic($easting, $northing, deg2rad($origin_latitude), deg2rad($origin_longitude), $false_easting, $false_northing, $k0, $a, $b, $latitude, $longitude);

$response->payload->latitude = round(rad2deg($latitude),8);
$response->payload->longitude = round(rad2deg($longitude),8);
$response->error->code = $err;
$response->error->what = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));