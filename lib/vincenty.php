<?php

require('error.php');
require('constants.php');

/** vincenty direct
 * 
 * computes a destination point on an ellipsoid 
 * surface from a given set of:
 * 
 * latitude, longitude of an origin point, azimuth
 * from the point to the destination, the distance
 * from the origin point to the destination point.
 * 
 * outputs: 
 * latitude and longitude of the destination point
 * and the azimuth of the geodesic at the destination.
 * 
 * lat1: latitude of the first point
 * lng1: longitude of the first point
 * dist: distance on ellipsoid surface
 * azimuth1: azimuth at the first point
 * a: semi-major axis of the ellipsoid
 * b: semi-minor axis of the ellipsoid
 * lat2: computed latitude of the destination point
 * lng2: computed longitude of the destination point
 * azimuth2: computed azimuth of geodesic at destination point
 */
function vincenty_direct($lat1, $lng1, $dist, $azimuth1, $a, $b, &$lat2, &$lng2, &$azimuth2) : int
{
    if(
        $lat1 > GDS_COMMON_MAX_LATITUDE || $lng1 > GDS_COMMON_MAX_LONGITUDE || 
        $lat1 < -GDS_COMMON_MAX_LATITUDE || $lng1 < -GDS_COMMON_MAX_LONGITUDE
      )
        return GoedeasyError::LatitudeLongitudeError;   
    // flattening
    $f = ($a - $b) / $a; 
    // reduced latitude of first point
    $U1 = atan((1 - $f) * tan($lat1));

    $sigma_1 = atan2(tan($U1), cos($azimuth1));

    $sin_alpha = cos($U1) * sin($azimuth1);

    $u_square = (1 - $sin_alpha * $sin_alpha) * ($a * $a - $b * $b) / ($b * $b);

    $A = 1 + $u_square / 16384 * (
        4096 + $u_square * (
            -768 + $u_square * (320 - 175 * $u_square)
        )
    );

    $B = $u_square / 1024 * (
        256 + $u_square * (
            -128 + $u_square * (
                74 - 47 * $u_square
            )
        ) 
    );

    $sigma = $dist / ($b * $A);

    $_2_sigma_m = .0;
    $d_sigma = .0;

    $epsilon = 1e-12;
    $diff = 1e20;
    while(abs($diff) > $epsilon) {

        $_2_sigma_m = 2 * $sigma_1 + $sigma;

        $d_sigma = $B * sin($sigma) * (
            cos($_2_sigma_m) + $B / 4 * (
                cos($sigma) * (-1 + 2 * pow(cos($_2_sigma_m), 2)) - $B / 6 * cos($_2_sigma_m) * (-3 + 4 * pow(sin($sigma), 2)) * (-3 + 4 * pow(cos($_2_sigma_m), 2))
            )
        );

        $diff = $sigma;
        $sigma = $dist / ($b * $A) + $d_sigma;
        $diff = $sigma - $diff;
    }

    // latitude of destination point
    $lat2 = atan2(sin($U1) * cos($sigma) + cos($U1) * sin($sigma) * cos($azimuth1),
        (1 - $f) * sqrt($sin_alpha * $sin_alpha + pow(sin($U1) * sin($sigma) - cos($U1) * cos($sigma) * cos($azimuth1),2))
    );

    $lambda = atan2(sin($sigma) * sin($azimuth1), cos($U1) * cos($sigma) - sin($U1) * sin($sigma) * cos($azimuth1));

    $C = $f / 16 * (1 - $sin_alpha * $sin_alpha) * (
        4 + $f * (4 - 3 * (1 - $sin_alpha * $sin_alpha)) 
    );

    // longitudinal difference between points
    $L = $lambda - (1 - $C) * $f * $sin_alpha * (
        $sigma + $C * sin($sigma) * (
            cos($_2_sigma_m) + $C * cos($sigma) * (
                -1 + 2 * cos($_2_sigma_m) * cos($_2_sigma_m)
            )
        )
    );

    // longitude of destination point
    $lng2 = $lng1 + $L; 
    // azimuth at destination point
    $azimuth2 = atan2($sin_alpha, -sin($U1) * sin($sigma) + cos($U1) * cos($sigma) * cos($azimuth1));

    if($azimuth2 < 0)
        $azimuth2 += 2 * M_PI;
    
    return GoedeasyError::NoError;
}

/** vincenty inverse 
 * 
 * computes the great circle distance (on ellipsoid surface)
 * between two points from a given set of:
 * 
 * latitude and longitude of first point, latitude and longitude
 * of second point.
 * 
 * outputs:
 * length of the geodesic (great circle distance) between these
 * two points, azimuth of the geodesic at the first point,
 * azimuth of the geodesic at the second point.
 * 
 * lat1: latitude of the first point
 * lng1: longitude of the first point
 * lat2: latitude of the destination point
 * lng2: longitude of the destination point
 * a: semi-major axis of the ellipsoid
 * b: semi-minor axis of the ellipsoid
 * azimuth: computed azimuth of geodesic at first point
 * azimuth2: computed azimuth of geodesic at second point
 * dist: computed distance on ellipsoid surface
*/

function vincenty_inverse($lat1, $lng1, $lat2, $lng2, $a, $b, &$azimuth, &$azimuth2, &$dist) : int
{
    if(
        $lat1 > GDS_COMMON_MAX_LATITUDE || $lng1 > GDS_COMMON_MAX_LONGITUDE || 
        $lat1 < -GDS_COMMON_MAX_LATITUDE || $lng1 < -GDS_COMMON_MAX_LONGITUDE || 
        $lat2 > GDS_COMMON_MAX_LATITUDE || $lng2 > GDS_COMMON_MAX_LONGITUDE ||
        $lat2 < -GDS_COMMON_MAX_LATITUDE || $lng2 < -GDS_COMMON_MAX_LONGITUDE
      )
        return GoedeasyError::LatitudeLongitudeError;

    // flattening
    $f = ($a - $b) / $a; 
    // reduced latitude of first point  
    $U1 = atan((1-$f) * tan($lat1));
    $sin_U1 = sin($U1);
    $cos_U1 = cos($U1);
    // reduced latitude of second point
    $U2 = atan((1-$f) * tan($lat2)); 
    $sin_U2 = sin($U2);
    $cos_U2 = cos($U2);
    // longitudinal difference on ellipsoid
    $L = $lng2 - $lng1; 
    // longitudinal difference on auxilliary sphere
    $lambda = $L;

    $sigma = .0; 
    $cos_2_sigma_m = .0; 
    $sin_sigma = .0; 
    $cos_sigma = .0; 
    $sin_alpha = .0;
    $sin_lambda = .0;
    $cos_lambda = .0;

    $epsilon = 1e-12;
    $diff = 1e20;
    while(abs($diff) > $epsilon)
    {
        $sin_lambda = sin($lambda);
        $cos_lambda = cos($lambda);
        $sin_sigma = sqrt(pow($cos_U2* $sin_lambda,2) + pow($cos_U1 * $sin_U2 - $sin_U1 * $cos_U2 * $cos_lambda,2));
        $cos_sigma = $sin_U1 * $sin_U2 + $cos_U1 * $cos_U2 * $cos_lambda;

        $sigma = atan2($sin_sigma, $cos_sigma);

        $sin_alpha = ($cos_U1 * $cos_U2 * $sin_lambda) / $sin_sigma;
        // cos(2 * sigma_m)
        $cos_2_sigma_m = $cos_sigma - (2 * $sin_U1 * $sin_U2) / (1 - pow($sin_alpha, 2));
        $C = $f / 16 * (1 - pow($sin_alpha, 2)) * (4 + $f * (4 - 3 * (1 - pow($sin_alpha, 2))));

        $diff = $lambda;
        $lambda = $L + (1 - $C) * $f * $sin_alpha * (
            $sigma + $C * $sin_sigma * (
                $cos_2_sigma_m + $C * $cos_sigma * (
                    -1 + 2 * $cos_2_sigma_m * $cos_2_sigma_m
                )
            )
        );

        if(abs($lambda) > M_PI)
            return GoedeasyError::VincentyConvergeError;

        $diff = $lambda - $diff;
    }

    $u_square = (1 -$sin_alpha * $sin_alpha) * ($a * $a - $b * $b) / ($b * $b);

    $A = 1 + $u_square / 16384 * (
        4096 + $u_square * (
            -768 + $u_square * (
                320 - 175 * $u_square
            )
        )
    );

    $B = $u_square / 1024 * (
        256 + $u_square * (
            -128 + $u_square * (
                74 - 47 * $u_square
            )
        )
    );

    $d_sigma = $B * $sin_sigma * (
        $cos_2_sigma_m + $B / 4 * (
            $cos_sigma * (-1 + 2 * pow($cos_2_sigma_m, 2)) - $B / 6 * $cos_2_sigma_m * (-3 + 4 * pow($sin_sigma, 2) * (-3 + 4 * pow($cos_2_sigma_m, 2)))
        ) 
    );

    $dist = $b * $A * ($sigma - $d_sigma);
    $azimuth = atan2($cos_U2 * $sin_lambda, $cos_U1 * $sin_U2 - $sin_U1 * $cos_U2 * $cos_lambda);
    $azimuth2 = atan2($cos_U1 * $sin_lambda, - $sin_U1 * $cos_U2 + $cos_U1 * $sin_U2 * $cos_lambda);

    if($azimuth < 0)
        $azimuth += M_PI * 2;
    if($azimuth2 < 0)
        $azimuth2 += M_PI * 2;
    return GoedeasyError::NoError;
}