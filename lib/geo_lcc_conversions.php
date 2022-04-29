<?php

require('error.php');

/**
 * 
 */
function geographic_to_lambert_conformal_conic_2sp($latitude, $longitude, $longitude0, $latitude0, 
    $latitude1, $latitude2, $E0, $N0, $k0, $a, $b, &$easting, &$northing) : int {

    $e_square = (pow($a,2) - pow($b,2)) / pow($a,2);
    $e = sqrt($e_square);
    
    $m1 = cos($latitude1) / sqrt(1 - $e_square * pow(sin($latitude1),2));
    $m2 = cos($latitude2) / sqrt(1 - $e_square * pow(sin($latitude2),2));
    $t = tan(M_PI_4 - $latitude / 2) / pow((1 - $e * sin($latitude) / (1 + $e * sin($latitude))), $e/2);
    $t0 = tan(M_PI_4 - $latitude0 / 2) / pow((1 - $e * sin($latitude0) / (1 + $e * sin($latitude0))), $e/2);
    $t1 = tan(M_PI_4 - $latitude1 / 2) / pow((1 - $e * sin($latitude1) / (1 + $e * sin($latitude1))), $e/2);
    $t2 = tan(M_PI_4 - $latitude2 / 2) / pow((1 - $e * sin($latitude2) / (1 + $e * sin($latitude2))), $e/2);
    
    $n = (log($m1) - log($m2)) / (log($t1) - log($t2));
    $F = $m1 / ($n * pow($t1, $n));
    $rho = $a * $F * pow($t, $n);
    $rho0 = $a * $F * pow($t0, $n);

    $gamma = $n * ($longitude - $longitude0);
    $northing = $N0 + $rho0 - $rho * cos($gamma);
    $easting = $E0 + $rho * sin($gamma);

    return GoedeasyError::NoError;
}

function lambert_conformal_conic_2sp_to_geographic($easting, $northing, $longitude0, $latitude0, 
$latitude1, $latitude2, $E0, $N0, $k0, $a, $b, &$latitude, &$longitude) : int {

    // $e_square = (pow($a,2) - pow($b,2)) / pow($a,2);
    // $e = sqrt($e_square);
    
    // $m1 = cos($latitude1) / sqrt(1 - $e_square * pow(sin($latitude1),2));
    // $m2 = cos($latitude2) / sqrt(1 - $e_square * pow(sin($latitude2),2));
    // $t = tan(M_PI_4 - $latitude / 2) / pow((1 - $e * sin($latitude) / (1 + $e * sin($latitude))), $e/2);
    // $t0 = tan(M_PI_4 - $latitude0 / 2) / pow((1 - $e * sin($latitude0) / (1 + $e * sin($latitude0))), $e/2);
    // $t1 = tan(M_PI_4 - $latitude1 / 2) / pow((1 - $e * sin($latitude1) / (1 + $e * sin($latitude1))), $e/2);
    // $t2 = tan(M_PI_4 - $latitude2 / 2) / pow((1 - $e * sin($latitude2) / (1 + $e * sin($latitude2))), $e/2);
    
    // $n = (log($m1) - log($m2)) / (log($t1) - log($t2));
    // $F = $m1 / ($n * pow($t1, $n));
    // $rho = $a * $F * pow($t, $n);
    // $rho0 = $a * $F * pow($t0, $n);

    // $N_ = $northing - $N0;
    // $E_ = $easting - $E0;

    // $rho_ = sqrt(pow($E_,2) + pow($rho0 - $N_,2));
    return GoedeasyError::NoError;
}