<?php

function geographic_to_xyz($latitude, $longitude, $height,
                  $a, $b, &$x, &$y, &$z): int
{
    if(($latitude > M_PI || $longitude > M_PI) || ($latitude < -M_PI || $longitude > M_PI))
        return 1; // latitude longitude error (convert to radian)    
    $eu_square = ($a * $a - $b * $b) / ($b * $b);
    $c = $a * $a / $b;
    $v1 = sqrt(1 + ($eu_square * (cos($latitude) * cos($latitude))));
    $N1 = $c / $v1;

    $x = ($N1 + $height) * cos($latitude) * cos($longitude);
    $y = ($N1 + $height) * cos($latitude) * sin($longitude);
    $z = (pow($b/$a, 2) * $N1 + $height) * sin($latitude);
    return 0;
}

function xyz_to_geographic($x, $y, $z, $a, $b, &$latitude, &$longitude, &$height) : int
{
    $e_square = ($a * $a - $b * $b) / ($a * $a);
    $eu_square = ($a * $a - $b * $b) / ($b * $b);
    $p = sqrt($x * $x + $y * $y);
    $longitude = atan2($y,$x);
    $beta = atan($a * $z / ($b * $p));
    $k1 = $z + $eu_square * $b * pow(sin($beta), 3);
    $k2 = $p - $e_square * $a * pow(cos($beta), 3);
    $latitude = atan2($k1,$k2);
    $c = pow($a, 2) / $b;
    $v = sqrt(1 + ($eu_square * pow(cos($latitude), 2)));
    $N = $c / $v;
    $height = ($p / cos($latitude)) - $N;
    return 0;
}