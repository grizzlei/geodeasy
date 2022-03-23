
### Destination API
Example:
```
http://localhost:53000/api/v1/destination.php?latitude=35.123&longitude=41.1235&distance=12413&azimuth=22&a=6378137.0&b=6356752.314245
```
Expected response:
```
{
    "destination": {
        "latitude": 35.22672767,
        "longitude": 41.17457877,
        "azimuth": 22.02942516
    }
}
```

### Great Circle Distance Calculation API
Example:
```
http://localhost:53000/api/v1/greatCircleDistance.php?latitude1=41.085136&longitude1=29.006844&latitude2=-44.9581658&longitude2=34.1099889&a=6378137.0&b=6356752.314245
```
Expected response:
```
{
    "great_circle_distance": {
        "azimuth": 176.36650218,
        "reverse_azimuth": 356.13025879,
        "distance": 9543920.826045722
    }
}
```