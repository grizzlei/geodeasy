### GeodEasy

[hasan karaman](https://hasankaraman.dev/whoami) - [hk@hasankaraman.dev](mailto:hk@hasankaraman.dev) - 2022

(This README is generated using [codebeautify.org/html-to-markdown](https://codebeautify.org/html-to-markdown))

* * *

Geodeasy is an open source tool for a set of basic and complicated geodetic computations. Although all of its code is available, you can still use its public REST API instead.

Geodeasy available tools:  
  
[Destination Calculation](#)  
[Great Circle Distance Calculation](#)  
[Lat/Lon to XYZ (ECEF) Conversions](#)  
[Geographic - Universal Transverse Mercator Conversions](#)  
[Geographic - Transverse Mercator Conversions](#)  
[Geographic - Lambert Conformal Conic Conversions](#)

* * *

Try out Geodeasy public REST API:  

\[[Try](http://localhost:53000/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245)\] /api/v1/destination.php  
\[[Try](http://localhost:53000/api/v1/great_circle_distance.php?latitude1=41.085136&longitude1=29.006844&latitude2=-44.9581658&longitude2=34.1099889&a=6378137.0&b=6356752.314245)\] /api/v1/great\_circle\_distance.php  
\[[Try](http://localhost:53000/api/v1/geo_to_xyz.php?latitude=35.123&longitude=41.1235&height=100&a=6378137.0&b=6356752.314245)\] /api/v1/conversions/geo\_to\_xyz.php  
\[[Try](http://localhost:53000/api/v1/xyz_to_geo.php?x=3934204.2181574507&y=3434867.698830731&z=3649094.041811154&a=6378137.0&b=6356752.314245)\] /api/v1/conversions/xyz\_to\_geo.php  
\[Try\] /api/v1/conversions/geo\_to\_utm.php  
\[Try\] /api/v1/conversions/utm\_to\_geo.php  
\[Try\] /api/v1/conversions/geo\_to\_tm.php  
\[Try\] /api/v1/conversions/tm\_to\_geo.php  
\[Try\] /api/v1/conversions/geo\_to\_lcc.php  
\[Try\] /api/v1/conversions/lcc\_to\_geo.php

All API calls and their example use are documented [here](#).

* * *

MIT License

Copyright (c) 2022 Hasan Karaman

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions: The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

This is a licence-free software, it can be used by anyone who try to build a better world.