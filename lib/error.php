<?php

function geodeasy_error_str($err) : string {
    switch ($err) {
        case 1:
            return 'GEODEASY_LATLON_ERROR';
        
        default:
            return 'GEODEASY_NO_ERROR';
    }
}