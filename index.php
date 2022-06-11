<?php
$base_url="geodeasy.org";
$api_destination="/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245";
$api_great_circle_distance="/api/v1/great_circle_distance.php?latitude1=41.085136&longitude1=29.006844&latitude2=-44.9581658&longitude2=34.1099889&a=6378137.0&b=6356752.314245";
$api_geo_to_xyz="/api/v1/geographic_to_xyz.php?latitude=35.123&longitude=41.1235&height=100&a=6378137.0&b=6356752.314245";
$api_xyz_to_geo="/api/v1/xyz_to_geographic.php?x=3934204.2181574507&y=3434867.698830731&z=3649094.041811154&a=6378137.0&b=6356752.314245";
$api_geo_to_utm="/api/v1/geographic_to_utm.php?latitude=35.123&longitude=41.1235&a=6378137.0&b=6356752.314245";
$api_utm_to_geo="/api/v1/utm_to_geographic.php?easting=693497.58&northing=3888747&utm_zone=37&hemisphere=N&a=6378137.0&b=6356752.314245";
$api_tm_to_geo="/api/v1/tm_to_geographic.php?easting=693497.58&northing=3888747&hemisphere=N&a=6378137.0&b=6356752.314245&lon0=39.0&lat0=0.0&k0=0.9996";
$api_geo_to_tm="/api/v1/geographic_to_tm.php?latitude=35.123&longitude=41.1235&a=6378137.0&b=6356752.314245&k0=0.9996&lat0=0.0&lon0=39.0";
$api_geo_to_lcc="/api/v1/geographic_to_lcc.php?a=6378137.0&b=6356752.314245&latitude=41.10487&longitude=29.01887&lat0=30.0&lon0=10.0&lat1=43.0&lat2=62.0";
$api_lcc_to_geo="";
?>
<html>
    <title>GeodEasy</title>
    <head>
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-ECXWC4T4NV"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-ECXWC4T4NV');
      </script>
    </head>
<body style="font-family:Helvetica; font-size:12px;">

<pre>
                       _ _____
   __ _  ___  ___   __| | ____|__ _ ___ _   _
  / _` |/ _ \/ _ \ / _` |  _| / _` / __| | | |
 | (_| |  __/ (_) | (_| | |__| (_| \__ \ |_| |
  \__, |\___|\___/ \__,_|_____\__,_|___/\__, |
  |___/                                 |___/

</pre>

<p>
Geodeasy is an open source tool for a set of basic and complicated geodetic
computations. Although all of its code is available, you can still use its
public REST API instead.
<p>
Geodeasy online tools:<p>

<a href="https://geodeasy.org/tools/destination.html" target="_blank">Destination calculation on ellipsoid</a><br>
<a href="https://geodeasy.org/tools/great_circle_distance.html" target="_blank">Great circle distance calculation on ellipsoid</a><br>
<a href="https://geodeasy.org/tools/geographic_to_xyz.html" target="_blank">Geographic to cartesian (earth-centered, earth-fixed) on ellipsoid</a><br>
<a href="https://geodeasy.org/tools/xyz_to_geographic.html" target="_blank">Cartesian to geographic (earth-centered, earth-fixed) on ellipsoid</a><br>
<a href="https://geodeasy.org/tools/utm_to_geographic.html" target="_blank">Universal Transverse Mercator to geographic on ellipsoid</a><br>
<a href="https://geodeasy.org/tools/geographic_to_utm.html" target="_blank">Geographic to Universal Transverse Mercator on ellipsoid</a><br>
<a href="https://geodeasy.org/tools/tm_to_geographic.html" target="_blank">Transverse Mercator to geographic on ellipsoid</a><br>
<a href="https://geodeasy.org/tools/geographic_to_tm.html" target="_blank">Geographic to Transverse Mercator on ellipsoid</a>

<hr>
<h3> API documentation and examples </h3>
A typical GET request to Geodeasy APIs:
<pre>
    https://geodeasy.org/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245
</pre><br>
A typical response body from Geodeasy APIs:
<pre>
{
    "payload": {
        "latitude": 35.22672767,
        "longitude": 41.17457877,
        "azimuth": 22.02942516
    },
    "error": {
        "code": 0,
        "what": "GEODEASY_NO_ERROR"
    },
    "warnings": []
}
</pre><br>
If something goes wrong, a descriptive warning or a pair of error code and text will be returned.
<p>
Try out Geodeasy public REST API:<br>
<p>
[<a href="https://<?php print($base_url.$api_destination) ?>"
target="_blank">Try</a>] <strong> /api/v1/destination.php </strong> <br />
Synopsis: Find latitude, longitude and the azimuth at the destination point on ellipsoid from given first point coordinates, azimuth and distance.<br />
Parameters: <strong>latitude</strong> (&deg;), <strong>longitude</strong> (&deg;), <strong>azimuth</strong> (&deg;), <strong>distance</strong> (m), ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>latitude</strong> (&deg;), <strong>longitude</strong> (&deg;) and <strong>azimuth</strong> (&deg;) at destination point.</p>
[<a href="https://<?php print($base_url.$api_great_circle_distance) ?>"
target="_blank">Try</a>] <strong> /api/v1/great_circle_distance.php </strong><br />
Synopsis: Find the distance between two points on ellipsoid.<br />
Parameters: ellipsoidal coordinates of first and second points (<strong>latitude1</strong>, <strong>longitude1, latitude2, longitude2</strong>), ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>azimuth</strong> (&deg;) at the first point, reverse azimuth (<strong>reverse_azimuth</strong>) (&deg;) at the second point and the <strong>distance</strong> (m).</p>
[<a href="https://<?php print($base_url.$api_geo_to_xyz) ?>"
target="_blank">Try</a>] <strong> /api/v1/geographic_to_xyz.php </strong><br />
Synopsis: Convert ellipsoidal coordinates of a point to x, y and z (ECEF) coordinates.<br />
Parameters: <strong>latitude</strong> (&deg;), <strong>longitude</strong> (&deg;) and ellipsoidal <strong>height</strong> of the point, ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>x</strong> (m), <strong>y</strong> (m), <strong>z</strong> (m) of the point.</p>
[<a href="https://<?php print($base_url.$api_xyz_to_geo) ?>"
target="_blank">Try</a>] <strong> /api/v1/xyz_to_geographic.php </strong><br />
Synopsis: Convert cartesian coordinates to ellipsoidal coordinates; latitude, longitude and height.<br />
Parameters: <strong>x</strong> (m), <strong>y</strong> (m), <strong>z</strong> (m) of the point and ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>latitude</strong> (&deg;), <strong>longitude</strong> (&deg;) and ellipsoidal <strong>height</strong> of the given point.</p>
[<a href="https://<?php print($base_url.$api_geo_to_utm) ?>"
target="_blank">Try</a>] <strong> /api/v1/geographic_to_utm.php </strong><br />
Synopsis: Convert ellipsoidal coordinates of a point to Universal Transverse Mercator (UTM) projection coordinates.<br />
Parameters: <strong>latitude</strong> (&deg;), <strong>longitude</strong> (&deg;) and ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>easting</strong> (m), <strong>northing</strong> (m), <strong>utm_zone</strong> and <strong>hemisphere</strong>.</p>
[<a href="https://<?php print($base_url.$api_utm_to_geo) ?>"
target="_blank">Try</a>] <strong> /api/v1/utm_to_geographic.php </strong><br />
Synopsis: Convert Universal Transverse Mercator (UTM) projection coordinates to latitude, longitude on a given ellipsoid.<br />
Parameters: <strong>easting</strong> (m), <strong>northing</strong> (m), UTM zone (<strong>utm_zone</strong>), <strong>hemisphere</strong> and ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>latitude</strong>, <strong>longitude</strong> of the point.</p>
[<a href="https://<?php print($base_url.$api_geo_to_tm) ?>"
target="_blank">Try</a>] <strong> /api/v1/geographic_to_tm.php </strong><br />
Synopsis: Convert ellipsoidal coordinates to Transverse Mercator projection coordinates.<br />
Parameters: <strong>latitude</strong> (&deg;) and <strong>longitude</strong> (&deg;) of the point, origin latitude (<strong>lat0</strong>) (&deg;), central meridian (<strong>lon0</strong>) (&deg;), scale factor (<strong>k0</strong>) and ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>easting</strong> (m), <strong>northing</strong> (m) and <strong>hemisphere</strong> of the point.</p>
[<a href="https://<?php print($base_url.$api_tm_to_geo) ?>"
target="_blank">Try</a>] <strong> /api/v1/tm_to_geographic.php </strong><br />
Synopsis: Convert Transverse Mercator projection coordinates to ellipsoidal coordinates.<br />
Parameters: <strong>easting</strong> (m), <strong>northing</strong> (m), <strong>hemisphere</strong>, origin latitude (<strong>lat0</strong>) (&deg;), central meridian (<strong>lon0</strong>) (&deg;), scale factor (<strong>k0</strong>) and ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>latitude</strong> (&deg;) and <strong>longitude</strong> (&deg;) of the point.</p>
[<a href="https://<?php print($base_url.$api_geo_to_lcc) ?>"
target="_blank">Try</a>] <strong> /api/v1/geographic_to_lcc.php </strong><br />
Synopsis: Convert ellipsoidal coordinates to Lambert Conformal Conic (LCC) projection coordinates.<br />
Parameters: <strong>latitude</strong> (&deg;) and <strong>longitude</strong> (&deg;) of the point, first standard parallel (<strong>lat1</strong>) (&deg;), second standard parallel (<strong>lat2</strong>) (&deg;), origin latitude (<strong>lat0</strong>) (&deg;), central meridian (<strong>lon0</strong>) (&deg;) and ellipsoid parameters <strong>a</strong> and <strong>b</strong>.<br />
Returns: <strong>easting</strong> (m) and <strong>northing</strong> (m) of the point.</p>
[<a>Try</a>] <strong>/api/v1/lcc_to_geographic.php </strong>
<p>
<hr>
<h3> Source & License </h3>
You can find Geodeasy source code here: <a href="https://github.com/grizzlei/geodeasy">github.com/grizzlei/geodeasy</a>
<p>
MIT License
<p>
Copyright (c) 2022 Hasan Karaman
<p>
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
<p>
This is a licence-free software, it can be used by anyone who try to build a
better world.
<hr>
<a href="https://hasankaraman.dev/whoami">hasan karaman (whoami)</a> - <a href="https://hasankaraman.dev">https://hasankaraman.dev</a> - <a href="mailto:hk@hasankaraman.dev">hk@hasankaraman.dev</a> - 2022

    </body>
</html>
