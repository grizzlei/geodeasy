<?php

require('../../lib/vincenty.php');
header('Content-type: application/json');

$lat=$_GET["latitude"];
$lng=$_GET["longitude"];
$dst=$_GET["distance"];
$azm=$_GET["azimuth"];
$a=$_GET["a"];
$b=$_GET["b"];

$lat2 = .0;
$lng2 = .0;
$azm2 = .0;

vincenty_direct(deg2rad($lat),deg2rad($lng),$dst, deg2rad($azm), $a, $b, $lat2, $lng2, $azm2);

$response->destination->latitude = (float)number_format(rad2deg($lat2),8);
$response->destination->longitude = (float)number_format(rad2deg($lng2),8);
$response->destination->azimuth = (float)number_format(rad2deg($azm2),8);

print(json_encode($response, JSON_PRETTY_PRINT));