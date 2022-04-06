<?php

require('error.php');
require('constants.php');

/**
 * latitude: latitude of the point
 * longitude: longitude of the point
 * latitude0: origin latitude
 * longitude0: center meridian
 * E0: false easting
 * N0: false northing
 * k0: scale factor at origin
 * a: semi-major axis of the ellipsoid 
 * b: semi-minor axis of the ellipsoid
 * easting: computed easting of the point
 * northing: computed northing of the point
 */
function geographic_to_transverse_mercator($latitude, $longitude, $latitude0, $longitude0, $E0, $N0, $k0, $a, $b, &$easting, &$northing) : int
{
    if(
        $latitude > GDS_TRANMERC_MAX_LATITUDE || 
        $longitude > GDS_COMMON_MAX_LONGITUDE || 
        $latitude < -GDS_TRANMERC_MAX_LATITUDE || 
        $longitude < -GDS_COMMON_MAX_LONGITUDE
      )
        return GoedeasyError::LatitudeLongitudeError;  

    if($latitude0 < -GDS_TRANMERC_MAX_ORIGIN_LATITUDE || $latitude0 > GDS_TRANMERC_MAX_ORIGIN_LATITUDE)
        return GoedeasyError::TransverseMercatorMaxOriginLatitudeError;

    $e_square = (pow($a,2) - pow($b,2)) / pow($a,2);

    $A0 = 1 - $e_square/4 - 3 * pow($e_square, 2) / 64 - 5 * pow($e_square, 3) / 256;
    $A2 = 3/8 * ($e_square + pow($e_square, 2)/4 + 15 * pow($e_square, 3)/128); 
    $A4 = 15/256 * (pow($e_square,2) + 3/4 * pow($e_square,3));
    $A6 = 35/3072 * pow($e_square,3);

    $m = $a * ($A0 * $latitude - $A2 * sin(2 * $latitude) + $A4 * sin(4 * $latitude) - $A6 * sin(6 * $latitude));
    $m0 = $a * ($A0 * $latitude0 - $A2 * sin(2 * $latitude0) + $A4 * sin(4 * $latitude0) - $A6 * sin(6 * $latitude0));

    $rho = $a * (1 - $e_square) / pow((1 - $e_square * pow(sin($latitude),2)),3/2);
    $ups = $a / sqrt(1 - $e_square * pow(sin($latitude),2));
    $psi = $ups / $rho;
    $t = tan($latitude);
    $omg = $longitude - $longitude0;
    
    $k1 = pow($omg, 2) / 2 * $ups * sin($latitude) * cos($latitude);
    $k2 = pow($omg, 4) / 24 * $ups * sin($latitude) * pow(cos($latitude),3) * (4 * pow($psi, 2) + $psi - pow($t, 2));
    $k3 = pow($omg, 6) / 720 * $ups * sin($latitude) * pow(cos($latitude), 5) * (
        8 * pow($psi, 4) * (11 - 24 * pow($t, 2)) 
        - 28 * pow($psi, 3) * (1 - 6 * pow($t, 2)) 
        + pow($psi,2) * (1 - 32 * pow($t, 2))
        - $psi * (2 * pow($t, 2)) + pow($t, 4)
    );
    $k4 = pow($omg, 8) / 40320 * $ups * sin($latitude) * pow(cos($latitude), 7) * (
        1385 - 3111 * pow($t, 2) + 543 * pow($t, 4) - pow($t, 6)
    );

    $northing = $N0 + $k0 * (
        $m - $m0 + $k1 + $k2 + $k3 + $k4
    );

    $p1 = pow($omg, 2) / 6 * pow(cos($latitude), 2) * ($psi - pow($t, 2));
    $p2 = pow($omg, 6) / 120 * pow(cos($latitude), 4) * (
        4 * pow($psi, 3) * (1 - 6 * pow($t, 2)) + pow($psi, 2) * (1 + 8 * pow($t, 2)) - $psi * 2 * pow($t, 2) + pow($t, 4)
    );
    $p3 = pow($omg, 6) / 5040 * pow(cos($latitude), 6) * (
        61 - 479 * pow($t, 2) + 179 * pow($t, 4) - pow($t, 6)
    );

    $easting = $E0 + $k0 * $ups * $omg * cos($latitude) * (
        1 + $p1 + $p2 + $p3
    );

    return GoedeasyError::NoError;
}

/**
 * easting: easting of the point
 * northing: northing of the point
 * latitude0: origin latitude
 * longitude0: center meridian
 * E0: false easting
 * N0: false northing
 * k0: scale factor at origin
 * a: semi-major axis of the ellipsoid 
 * b: semi-minor axis of the ellipsoid
 * latitude: computed latitude of the point
 * longitude: computed longitude of the point
 */
function transverse_mercator_to_geographic($easting, $northing, $latitude0, $longitude0, $E0, $N0, $k0, $a, $b, &$latitude, &$longitude) : int 
{
    $e_square = (pow($a,2) - pow($b,2)) / pow($a,2);

    $A0 = 1 - $e_square/4 - 3 * pow($e_square, 2) / 64 - 5 * pow($e_square, 3) / 256;
    $A2 = 3/8 * ($e_square + pow($e_square, 2)/4 + 15 * pow($e_square, 3)/128); 
    $A4 = 15/256 * (pow($e_square,2) + 3/4 * pow($e_square,3));
    $A6 = 35/3072 * pow($e_square,3);

    $m0 = $a * ($A0 * $latitude0 - $A2 * sin(2 * $latitude0) + $A4 * sin(4 * $latitude0) - $A6 * sin(6 * $latitude0));

    $N_ = $northing - $N0;
    $m_ = $m0 + $N_ / $k0;
    $n = ($a - $b) / ($a + $b);
    $G = $a * (1 - $n) * (1 - pow($n,2)) * (1 + 9/4 * pow($n,2) + 225/64 * pow($n,4)) * M_PI / 180;

    $sigma = ($m_ * M_PI) / (180 * $G);

    $phi_ = $sigma + (3/2 * $n - 27/32 * pow($n,3)) * sin(2 * $sigma) + (21/16 * pow($n,2) - 55/32 * pow($n,4)) * sin(4 * $sigma) + 
        (151/96 * pow($n,3)) * sin(6 * $sigma) + (1097/512 * pow($n,4)) * sin(8 * $sigma);

    $rho_ = $a * (1 - $e_square) / pow(1 - $e_square * pow(sin($phi_),2),3/2);
    $ups_ = $a / sqrt(1 - $e_square * pow(sin($phi_),2));
    $psi_ = $ups_ / $rho_;
    $t_ = tan($phi_);
    $E_ = $easting - $E0;
    $x = $E_ / ($k0 * $ups_);

    $t1 = $t_ * $E_ * $x / ($k0 * $rho_ * 2);
    $t2 = $t_ * $E_ * pow($x, 3) / ($k0 * $rho_ * 24) * (
        -4 * pow($psi_, 2) + 9 * $psi_ * (1 - pow($t_,2)) + 12 * pow($t_, 4)
    );
    $t3 = $t_ * $E_ * pow($x, 5) / ($k0 * $rho_ * 720) * (
        8 * pow($psi_, 4) * (11 - 24 * pow($t_, 2)) - 12 * pow($psi_, 3) * (21 - 71 * pow($t_, 2))
        + 15 * pow($psi_, 2) * (15 - 98 * pow($t_, 2) + 15 * pow($t_, 4)) 
        + 180 * $psi_ * ( 5 * pow($t_, 2) - 3 * pow($t_, 4)) + 360 * pow($t_, 4)
    );
    $t4 = $t_ * $E_ * pow($x, 7) / ($k0 * $rho_ * 40320) * (
        1385 + 3633 * pow($t_, 2) + 4095 * pow($t_,4) + 1575 * pow($t_, 6)
    );

    $latitude = $phi_ - $t1 + $t2 - $t3 + $t4;

    $p1 = $x / cos($phi_);
    $p2 = pow($x,3) / (cos($phi_) * 6) * ($psi_ + 2 * pow($t_, 2));
    $p3 = pow($x,5) / (cos($phi_) * 120) * (-4 * pow($psi_,3) * (1 - 6 * pow($t_,2)) + pow($psi_,2) * (9 - 67 * pow($t_, 2)) 
    +72 * $psi_ * pow($t_,2) + 24 * pow($t_,4));
    $p4 = pow($x,7) / (cos($phi_) * 5040) * (61 + 662 * pow($t_, 2) + 1320 * pow($t_,4) + 720 * pow($t_, 6));

    $longitude = $longitude0 + $p1 - $p2 + $p3 - $p4;
    return GoedeasyError::NoError;
}
