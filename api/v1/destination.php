<?php

require('../../lib/vincenty.php');
header('Content-type: application/json');

ini_set('serialize_precision', 8);

$lat=$_GET["latitude"];
$lng=$_GET["longitude"];
$dst=$_GET["distance"];
$azm=$_GET["azimuth"];
$a=$_GET["a"];
$b=$_GET["b"];

$lat2 = .0;
$lng2 = .0;
$azm2 = .0;

$err = vincenty_direct(deg2rad($lat),deg2rad($lng),$dst, deg2rad($azm), $a, $b, $lat2, $lng2, $azm2);

$response->payload->latitude = round(rad2deg($lat2),8);
$response->payload->longitude = round(rad2deg($lng2),8);
$response->payload->azimuth = round(rad2deg($azm2),8);
$response->error = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));