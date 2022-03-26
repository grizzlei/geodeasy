<?php
$base_url="localhost:53000";
$destination_api_path="/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245";
$gcd_api_path="/api/v1/great_circle_distance.php?latitude1=41.085136&longitude1=29.006844&latitude2=-44.9581658&longitude2=34.1099889&a=6378137.0&b=6356752.314245";
$geo_to_xyz_api_path="/api/v1/geo_to_xyz.php?latitude=35.123&longitude=41.1235&height=100&a=6378137.0&b=6356752.314245";
$xyz_to_geo_api_path="/api/v1/xyz_to_geo.php?x=3934204.2181574507&y=3434867.698830731&z=3649094.041811154&a=6378137.0&b=6356752.314245";
?>
<html>
    <title>GeodEasy</title>
<body style="width:25%; font-family:Helvetica; font-size:12px;">
    
    <h3>GeodEasy</h3>
<a href="https://hasankaraman.dev/whoami">hasan karaman</a> - <a href="mailto:hk@hasankaraman.dev">hk@hasankaraman.dev</a> - 2022
<hr>

Geodeasy is an open source tool for a set of basic and complicated geodetic
computations. Although all of its code is available, you can still use its
public REST API instead.
<p>
Geodeasy available tools:<br><br>

<a href="#">Destination Calculation</a><br>
<a href="#">Great Circle Distance Calculation</a><br>
<a href="#">Lat/Lon to XYZ (ECEF) Conversions</a><br>
<a href="#">Geographic - Universal Transverse Mercator Conversions</a><br>
<a href="#">Geographic - Transverse Mercator Conversions</a><br>
<a href="#">Geographic - Lambert Conformal Conic Conversions</a>

<hr>
Try out Geodeasy public REST API:<br>
<p>
[<a href="http://<?php print($base_url.$destination_api_path) ?>"
target="_blank">Try</a>] /api/v1/destination.php<br>
[<a href="http://<?php print($base_url.$gcd_api_path) ?>"
target="_blank">Try</a>] /api/v1/great_circle_distance.php<br>
[<a href="http://<?php print($base_url.$geo_to_xyz_api_path) ?>"
target="_blank">Try</a>] /api/v1/conversions/geo_to_xyz.php<br>
[<a href="http://<?php print($base_url.$xyz_to_geo_api_path) ?>"
target="_blank">Try</a>] /api/v1/conversions/xyz_to_geo.php<br>
[<a>Try</a>] /api/v1/conversions/geo_to_utm.php<br>
[<a>Try</a>] /api/v1/conversions/utm_to_geo.php<br>
[<a>Try</a>] /api/v1/conversions/geo_to_tm.php<br>
[<a>Try</a>] /api/v1/conversions/tm_to_geo.php<br>
[<a>Try</a>] /api/v1/conversions/geo_to_lcc.php<br>
[<a>Try</a>] /api/v1/conversions/lcc_to_geo.php
<p>
All API calls and their example use are documented <a href="#">here</a>.
<hr>
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
    </body>
</html>