<?php
$base_url="geodeasy.org";
$api_destination="/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245";
$api_great_circle_distance="/api/v1/great_circle_distance.php?latitude1=41.085136&longitude1=29.006844&latitude2=-44.9581658&longitude2=34.1099889&a=6378137.0&b=6356752.314245";
$api_geo_to_xyz="/api/v1/geographic_to_xyz.php?latitude=35.123&longitude=41.1235&height=100&a=6378137.0&b=6356752.314245";
$api_xyz_to_geo="/api/v1/xyz_to_geographic.php?x=3934204.2181574507&y=3434867.698830731&z=3649094.041811154&a=6378137.0&b=6356752.314245";
$api_geo_to_utm="/api/v1/geographic_to_utm.php?latitude=35.123&longitude=41.1235&a=6378137.0&b=6356752.314245";
$api_utm_to_geo="/api/v1/utm_to_geographic.php?easting=693497.58&northing=3888747&utm_zone=37&hemisphere=N&a=6378137.0&b=6356752.314245"
?>
<html>
    <title>GeodEasy</title>
<body style="width:25%; font-family:Helvetica; font-size:12px;">
    
<h3>GeodEasy</h3>
<a href="https://geodeasy.org">Website (geodeasy.org)</a> 
<p>
<h3> Intro </h3>
Geodeasy is an open source tool for a set of basic and complicated geodetic
computations. Although all of its code is available, you can still use its
public REST API instead.
<p>
Geodeasy available online tools: (coming soon)<p>

<a href="#">Destination calculation on ellipsoid</a><br>
<a href="#">Great circle distance calculation on ellipsoid</a><br>
<a href="#">Geographic - Cartesian (earth-centered, earth-fixed) conversions on ellipsoid</a><br>
<a href="#">Geographic - Universal Transverse Mercator conversions on ellipsoid</a><br>
<a href="#">Geographic - Transverse Mercator conversions on ellipsoid</a><br>
<a href="#">Geographic - Lambert Conformal Conic conversions on ellipsoid</a>

<hr>
<h3> API documentation and examples </h3>
Try out Geodeasy public REST API:<br>
<p>
[<a href="https://<?php print($base_url.$api_destination) ?>"
target="_blank">Try</a>] /api/v1/destination.php<br>
[<a href="https://<?php print($base_url.$api_great_circle_distance) ?>"
target="_blank">Try</a>] /api/v1/great_circle_distance.php<br>
[<a href="https://<?php print($base_url.$api_geo_to_xyz) ?>"
target="_blank">Try</a>] /api/v1/geo_to_xyz.php<br>
[<a href="https://<?php print($base_url.$api_xyz_to_geo) ?>"
target="_blank">Try</a>] /api/v1/xyz_to_geo.php<br>
[<a href="https://<?php print($base_url.$api_geo_to_utm) ?>"
target="_blank">Try</a>] /api/v1/geographic_to_utm.php<br>
[<a href="https://<?php print($base_url.$api_utm_to_geo) ?>"
target="_blank">Try</a>] /api/v1/utm_to_geographic.php<br>
[<a>Try</a>] /api/v1/geographic_to_tm.php<br>
[<a>Try</a>] /api/v1/tm_to_geographic.php<br>
[<a>Try</a>] /api/v1/geographic_to_lcc.php<br>
[<a>Try</a>] /api/v1/lcc_to_geographic.php
<p>
All API calls and their example use are documented <a href="#">here</a> (coming soon).
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