### GeodEasy
(This README is simply index.php except this line, converted to markdown using [codebeautify.org/html-to-markdown](https://codebeautify.org/html-to-markdown))
### Intro

Geodeasy is an open source tool for a set of basic and complicated geodetic computations. Although all of its code is available, you can still use its public REST API instead.

Geodeasy available online tools:

[Destination calculation on ellipsoid](https://geodeasy.org/tools/destination.html)  
[Great circle distance calculation on ellipsoid](https://geodeasy.org/tools/great_circle_distance.html)  
[Geographic to cartesian (earth-centered, earth-fixed) on ellipsoid](https://geodeasy.org/tools/geographic_to_xyz.html)  
[Cartesian to geographic (earth-centered, earth-fixed) on ellipsoid](https://geodeasy.org/tools/xyz_to_geographic.html)  
[Universal Transverse Mercator to geographic on ellipsoid](https://geodeasy.org/tools/utm_to_geographic.html)  
[Geographic to Universal Transverse Mercator on ellipsoid](https://geodeasy.org/tools/geographic_to_utm.html)  
[Transverse Mercator to geographic on ellipsoid](https://geodeasy.org/tools/tm_to_geographic.html)  
[Geographic to Transverse Mercator on ellipsoid](https://geodeasy.org/tools/geographic_to_tm.html)

* * *

### API documentation and examples

Try out Geodeasy public REST API:  

\[[Try](https://geodeasy.org/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245)\] **/api/v1/destination.php**  
Synopsis: Find latitude, longitude and the azimuth at the destination point on ellipsoid from given first point coordinates, azimuth and distance.  
Parameters: latitude, longitude, azimuth, distance.  
Returns: latitude (°), longitude (°) and azimuth (°) at destination point.

\[[Try](https://geodeasy.org/api/v1/great_circle_distance.php?latitude1=41.085136&longitude1=29.006844&latitude2=-44.9581658&longitude2=34.1099889&a=6378137.0&b=6356752.314245)\] **/api/v1/great\_circle\_distance.php**  
Synopsis: Find the distance between two points on ellipsoid.  
Parameters: ellipsoidal coordinates of first and second points, ellipsoid parameters.  
Returns: azimuth (°) at the first point, reverse azimuth (°) at the second point and the distance (m).

\[[Try](https://geodeasy.org/api/v1/geographic_to_xyz.php?latitude=35.123&longitude=41.1235&height=100&a=6378137.0&b=6356752.314245)\] **/api/v1/geographic\_to\_xyz.php**  
Synopsis: Convert ellipsoidal coordinates of a point to x, y and z (ECEF) coordinates.  
Parameters: latitude (°) and longitude (°) of the point, ellipsoid parameters.  
Returns: x (m), y (m), z (m) of the point.

\[[Try](https://geodeasy.org/api/v1/xyz_to_geographic.php?x=3934204.2181574507&y=3434867.698830731&z=3649094.041811154&a=6378137.0&b=6356752.314245)\] **/api/v1/xyz\_to\_geographic.php**  
Synopsis: Convert cartesian coordinates to ellipsoidal coordinates; latitude, longitude and height.  
Parameters: x (m), y (m), z (m) of the point and ellipsoid parameters.  
Returns: latitude (°), longitude (°) of the given point.

\[[Try](https://geodeasy.org/api/v1/geographic_to_utm.php?latitude=35.123&longitude=41.1235&a=6378137.0&b=6356752.314245)\] **/api/v1/geographic\_to\_utm.php**  
Synopsis: Convert ellipsoidal coordinates of a point to Universal Transverse Mercator (UTM) projection coordinates.  
Parameters: latitude (°), longitude (°) and ellipsoid parameters.  
Returns: easting (m), northing (m), UTM zone and hemisphere.

\[[Try](https://geodeasy.org/api/v1/utm_to_geographic.php?easting=693497.58&northing=3888747&utm_zone=37&hemisphere=N&a=6378137.0&b=6356752.314245)\] **/api/v1/utm\_to\_geographic.php**  
Synopsis: Convert Universal Transverse Mercator (UTM) projection coordinates to latitude, longitude on a given ellipsoid.  
Parameters: easting (m), northing (m), UTM zone, hemisphere and ellipsoid parameters.  
Returns: latitude longitude of the point.

\[[Try](https://geodeasy.org/api/v1/geographic_to_tm.php?latitude=35.123&longitude=41.1235&a=6378137.0&b=6356752.314245&k0=0.9996&lat0=0.0&lon0=39.0)\] **/api/v1/geographic\_to\_tm.php**  
Synopsis: Convert ellipsoidal coordinates to Transverse Mercator projection coordinates.  
Parameters: latitude (°) and longitude (°) of the point, origin latitude (°), central meridian (°) of the zone and ellipsoid parameters.  
Returns: easting (m), northing (m) and hemisphere of the point.

\[[Try](https://geodeasy.org/api/v1/tm_to_geographic.php?easting=693497.58&northing=3888747&hemisphere=N&a=6378137.0&b=6356752.314245&lon0=39.0&lat0=0.0&k0=0.9996)\] **/api/v1/tm\_to\_geographic.php**  
Synopsis: Convert Transverse Mercator projection coordinates to ellipsoidal coordinates.  
Parameters: easting (m), northing (m), hemisphere, origin latitude (°), central meridian (°), scale factor and ellipsoid parameters.  
Returns: latitude (°) and longitude (°) of the point.

\[[Try](https://geodeasy.org/api/v1/geographic_to_lcc.php?a=6378137.0&b=6356752.314245&latitude=41.10487&longitude=29.01887&lat0=30.0&lon0=10.0&lat1=43.0&lat2=62.0)\] **/api/v1/geographic\_to\_lcc.php**  
Synopsis: Convert ellipsoidal coordinates to Lambert Conformal Conic (LCC) projection coordinates.  
Parameters: latitude (°) and longitude (°) of the point, first standard parallel (°), second standard parallel (°), origin latitude (°), central meridian (°) and ellipsoid parameters.  
Returns: easting (m) and northing (m) of the point.

\[Try\] **/api/v1/lcc\_to\_geographic.php**

* * *

### Source & License

You can find Geodeasy source code here: [github.com/grizzlei/geodeasy](https://github.com/grizzlei/geodeasy)

MIT License

Copyright (c) 2022 Hasan Karaman

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions: The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

This is a licence-free software, it can be used by anyone who try to build a better world.

* * *

[hasan karaman (whoami)](https://hasankaraman.dev/whoami) - [https://hasankaraman.dev](https://hasankaraman.dev) - [hk@hasankaraman.dev](mailto:hk@hasankaraman.dev) - 2022