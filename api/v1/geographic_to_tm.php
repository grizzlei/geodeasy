<?php

require('../../lib/geo_tm_conversions.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);
$warnings = [];

$a=$_GET["a"];
if($a === null) {
    $a = GDS_WGS84_SEMI_MAJOR;
    array_push($warnings, "Semi-major axis missing, assigned to default (".number_format($a, 6).").");
}

$b=$_GET["b"];
if($b === null) {
    $b = GDS_WGS84_SEMI_MINOR;
    array_push($warnings, "Semi-minor axis missing, assigned to default (".number_format($b, 6).").");
}

$lat=$_GET["latitude"];

$lng=$_GET["longitude"];
$lat0=$_GET["lat0"];
$lon0=$_GET["lon0"];
$k0 = $_GET["k0"] ?? GDS_TM_SCALE_FACTOR;
if($k0 === null) {
    $k0 = GDS_TM_SCALE_FACTOR;
    array_push($warnings, "Scale factor missing, assigned to default (".$k0.")");
}

$easting = .0;
$northing = .0;

$E0 = GDS_TM_FALSE_EASTING;
$N0 = $lat < 0 ? GDS_TM_FALSE_NORTHING : 0;

$err = geographic_to_transverse_mercator(deg2rad($lat), deg2rad($lng), deg2rad($lat0), deg2rad($lon0), $E0, $N0, $k0, $a, $b, $easting, $northing);

$response->payload->easting = round($easting,3);
$response->payload->northing = round($northing,3);
$response->payload->hemisphere = $lat > 0 ? 'Northern' : 'Southern';
$response->error->code = $err;
$response->error->what = geodeasy_error_str($err);
$response->warnings = $warnings;

print(json_encode($response, JSON_PRETTY_PRINT));