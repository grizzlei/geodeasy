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
        $latitude > GDS_TM_MAX_LATITUDE || 
        $longitude > GDS_COMMON_MAX_LONGITUDE || 
        $latitude < -GDS_TM_MAX_LATITUDE || 
        $longitude < -GDS_COMMON_MAX_LONGITUDE
      )
        return GoedeasyError::LatitudeLongitudeError;  

    if($latitude0 < -GDS_TM_MAX_ORIGIN_LATITUDE || $latitude0 > GDS_TM_MAX_ORIGIN_LATITUDE)
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
    $e2 = (pow($a,2) - pow($b,2)) / pow($a,2);
    $e4 = $e2 * $e2;
    $e6 = $e4 * $e2;

    $A0 = 1 - $e2/4 - 3 * $e4 / 64 - 5 * $e6 / 256;
    $A2 = 3/8 * ($e2 + pow($e2, 2)/4 + 15 * $e6/128); 
    $A4 = 15/256 * ($e4 + 3/4 * $e6);
    $A6 = 35/3072 * $e6;

    $N_ = $northing - $N0;
    $m0 = $a * ($A0 * $latitude0 - $A2 * sin(2 * $latitude0) + $A4 * sin(4 * $latitude0) - $A6 * sin(6 * $latitude0));
    $m_ = $m0 + $N_/$k0;

    $n = ($a-$b)/($a+$b);
    $n2 = $n * $n;
    $n3 = $n2 * $n;
    $n4 = $n2 * $n2;

    $G = $a * (1-$n) * (1-$n2) * (1 + 9 * $n2/4 + 225 * $n4 / 64) * (M_PI / 180);

    $sig = $m_ * M_PI / (180 * $G);
    $phi_ = $sig + (3 * $n/2 - 27 * $n3 / 32) * sin(2*$sig) + (21 * $n2/16 - 55 * $n4/32) * sin(4 * $sig)
        + (151 * $n3 / 96) * sin(6 * $sig) + (1097 * $n4 / 512) * sin(8 * $sig);

    $sin_phi_ = sin($phi_);

    $rho_ = $a * (1 - $e2) / pow(1 - $e2 * $sin_phi_ * $sin_phi_, 3/2);
    $nu_ = $a / sqrt(1 - $e2 * $sin_phi_ * $sin_phi_);
    
    $psi_ = $nu_ / $rho_;
    $psi_2 = $psi_ * $psi_;
    $psi_3 = $psi_2 * $psi_;
    $psi_4 = $psi_2 * $psi_2;

    $t_ = tan($phi_);
    $t_2 = $t_ * $t_;
    $t_4 = $t_2 * $t_2;
    $t_6 = $t_4 * $t_2;

    $E_ = $easting - $E0;
    $x = $E_ / ($k0 * $nu_);
    $x2 = $x * $x;
    $x3 = $x2 * $x;
    $x5 = $x3 * $x2;
    $x7 = $x5 * $x2;

    $k1 = $t_ * $E_ * $x / ($k0 * $rho_ * 2);
    $k2 = $t_ * $E_ * $x3 / ($k0 * $rho_ * 24) * (-4 * $psi_2 + 9 * $psi_ * (1 - $t_2) + 12 * $t_2);
    $k3 = $t_ * $E_ * $x5 / ($k0 * $rho_ * 720) * (8 * $psi_4 * (11 - 24 * $t_2) 
        - 12 * $psi_3 * (21 - 71 * $t_2) + 15 * $psi_2 * (15 - 98* $t_2 + 15 * $t_4) + 180 * $psi_ * (5 * $t_2 - 3 * $t_4) + 360 * $t_4);
    $k4 = $t_ * $E_ * $x7 / ($k0 * $rho_ * 40320) * (1385 + 3633 * $t_2 + 4095 * $t_4 + 1575 * $t_6);

    $latitude = $phi_ - $k1 + $k2 - $k3 + $k4;

    $rho = $a * (1 - $e2) / pow(1 - $e2 * sin($latitude) * sin($latitude), 3/2);
    $nu = $a / sqrt(1 - $e2 * sin($latitude) * sin($latitude));
    $psi = $nu / $rho;
    $psi2 = $psi * $psi;
    $psi3 = $psi2 * $psi;

    $sec_phi = 1/cos($phi_);
    $p1 = $x * $sec_phi;
    $p2 = $x3 * $sec_phi / 6 * ($psi + 2 * $t_2);
    $p3 = $x5 * $sec_phi / 120 * (-4 * $psi3 * (1 - 6 * $t_2) + $psi2 * (9 - 68 * $t_2) + 72 * $psi * $t_2 + 24 * $t_4);
    $p4 = $x7 * $sec_phi / 5040 * (61 + 662 * $t_2 + 1320 * $t_4 + 720 * $t_6);

    $longitude = $longitude0 + $p1 - $p2 + $p3 - $p4;

    return GoedeasyError::NoError;
}