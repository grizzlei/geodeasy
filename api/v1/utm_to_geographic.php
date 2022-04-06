<?php

require('../../lib/geo_tm_conversions.php');
header('Content-type: application/json');

ini_set('serialize_precision', 8);

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
$false_easting = GDS_TRANMERC_FALSE_EASTING;
$false_northing = 0.;

if($hemisphere == 'N')
    $false_northing = 0;
else if($hemisphere == 'S')
    $false_northing = GDS_TRANMERC_FALSE_NORTHING;

$err = transverse_mercator_to_geographic($easting, $northing, deg2rad($origin_latitude), deg2rad($origin_longitude), $false_easting, $false_northing, $k0, $a, $b, $latitude, $longitude);

$response->payload->latitude = round(rad2deg($latitude), 8);
$response->payload->longitude = round(rad2deg($longitude), 8);
$response->error = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));