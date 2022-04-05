### GeodEasy

[Website (geodeasy.org)](https://geodeasy.org)

(This README is simply index.php except this line, converted to markdown using [codebeautify.org/html-to-markdown](https://codebeautify.org/html-to-markdown))

### Intro

Geodeasy is an open source tool for a set of basic and complicated geodetic computations. Although all of its code is available, you can still use its public REST API instead.

Geodeasy available online tools: (coming soon)

[Destination calculation on ellipsoid](#)  
[Great circle distance calculation on ellipsoid](#)  
[Geographic - Cartesian (earth-centered, earth-fixed) conversions on ellipsoid](#)  
[Geographic - Universal Transverse Mercator conversions on ellipsoid](#)  
[Geographic - Transverse Mercator conversions on ellipsoid](#)  
[Geographic - Lambert Conformal Conic conversions on ellipsoid](#)

* * *

### API documentation and examples

Try out Geodeasy public REST API:  

\[[Try](https://geodeasy.org/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245)\] /api/v1/destination.php  
\[[Try](https://geodeasy.org/api/v1/great_circle_distance.php?latitude1=41.085136&longitude1=29.006844&latitude2=-44.9581658&longitude2=34.1099889&a=6378137.0&b=6356752.314245)\] /api/v1/great\_circle\_distance.php  
\[[Try](https://geodeasy.org/api/v1/geographic_to_xyz.php?latitude=35.123&longitude=41.1235&height=100&a=6378137.0&b=6356752.314245)\] /api/v1/geo\_to\_xyz.php  
\[[Try](https://geodeasy.org/api/v1/xyz_to_geographic.php?x=3934204.2181574507&y=3434867.698830731&z=3649094.041811154&a=6378137.0&b=6356752.314245)\] /api/v1/xyz\_to\_geo.php  
\[[Try](https://geodeasy.org/api/v1/geographic_to_utm.php?latitude=35.123&longitude=41.1235&a=6378137.0&b=6356752.314245)\] /api/v1/geographic\_to\_utm.php  
\[[Try](https://geodeasy.org/api/v1/utm_to_geographic.php?easting=693497.58&northing=3888747&utm_zone=37&hemisphere=N&a=6378137.0&b=6356752.314245)\] /api/v1/utm\_to\_geographic.php  
\[Try\] /api/v1/geographic\_to\_tm.php  
\[Try\] /api/v1/tm\_to\_geographic.php  
\[Try\] /api/v1/geographic\_to\_lcc.php  
\[Try\] /api/v1/lcc\_to\_geographic.php

All API calls and their example use are documented [here](#) (coming soon).

* * *

### Source & License

You can find GeodEasy source code here: [github.com/grizzlei/geodeasy](https://github.com/grizzlei/geodeasy)

MIT License

Copyright (c) 2022 Hasan Karaman

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions: The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

This is a licence-free software, it can be used by anyone who try to build a better world.

* * *

[hasan karaman (whoami)](https://hasankaraman.dev/whoami) - [https://hasankaraman.dev](https://hasankaraman.dev) - [hk@hasankaraman.dev](mailto:hk@hasankaraman.dev) - 2022