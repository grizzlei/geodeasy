<?php

require('../../lib/geo_lcc_conversions.php');
header('Content-type: application/json');

ini_set('precision', 8);
ini_set('serialize_precision', -1);

// latitude of the point
$lat = (float)$_GET["latitude"];
// longitude of the point
$lng = (float)$_GET["longitude"];
// semi-major axis of the ellipsoid, default is wgs84 semi-major (6378137.0)
$a = (float)$_GET["a"] ?? GDS_WGS84_SEMI_MAJOR;
// semi-minor axis of the ellipsoid, default is wgs84 semi-minor (6356752.314245)
$b = (float)$_GET["b"] ?? GDS_WGS84_SEMI_MINOR;
// central meridian
$lon0 = (float)$_GET["lon0"];
// latitude of origin
$lat0 = (float)$_GET["lat0"]; 
// standard parallel 1
$lat1 = (float)$_GET["lat1"];
// standard parallel 2 
$lat2 = (float)$_GET["lat2"];
// false easting, default is 0.0
$E0 = (float)$_GET["E0"] ?? 0.;
// false northing, default is 0.0
$N0 = (float)$_GET["N0"] ?? 0.;
// scale factor
$k0 = 1.0;
// easting of the point
$easting = .0;
// northing of the point
$northing = .0;

$err = geographic_to_lambert_conformal_conic_2sp(deg2rad($lat), deg2rad($lng), deg2rad($lon0), 
    deg2rad($lat0), deg2rad($lat1), deg2rad($lat2), $E0, $N0, $k0, $a, $b, $easting, $northing);

$response->payload->easting = round($easting,3);
$response->payload->northing = round($northing,3);
$response->error->code = $err;
$response->error->what = geodeasy_error_str($err);
$response->warnings = [];

print(json_encode($response, JSON_PRETTY_PRINT));