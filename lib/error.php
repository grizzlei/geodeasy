<?php

abstract class GoedeasyError
{
    const NoError = 0;
    const LatitudeLongitudeError = 1;
    const OriginLatitudeError = 2;
    const TransverseMercatorMaxLatitudeError = 3;
    const TransverseMercatorMaxOriginLatitudeError = 4;
    const VincentyConvergeError = 5;
}

function geodeasy_error_str($err) : string {
    switch ($err) {
        case 1:
            return 'GEODEASY_LATLON_ERROR';
        case 2:
            return 'GEODEASY_ORIGIN_LATITUDE_ERROR';
        case 3:
            return 'GEODEASY_TRANMERC_MAXIMUM_LATITUDE_ERROR';
        case 4:
            return 'GEODEASY_TRANMERC_MAXIMUM_ORIGIN_LATITUDE_ERROR';
        case 5:
            return 'GEODEASY_VINCENTY_CONVERGE_ERROR';
        default:
            return 'GEODEASY_NO_ERROR';
    }
}