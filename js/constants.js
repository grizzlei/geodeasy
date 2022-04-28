import {Ellipsoid} from "./types.js";

export const kEllipsoids = new Map(); {
    kEllipsoids.set("WGS84", new Ellipsoid(6378137, 6356752.3142, "WGS84")),
    kEllipsoids.set("GRS80", new Ellipsoid(6378137, 6356752.3141, "GRS80")),
    kEllipsoids.set("HAYFORD", new Ellipsoid(6378388, 6356911.946, "HAYFORD")),
    kEllipsoids.set("CLARKE", new Ellipsoid(6378249.145, 6356514.870, "CLARKE")),
    kEllipsoids.set("BESSEL", new Ellipsoid(6377397.155, 6356078.963, "BESSEL")),
    kEllipsoids.set("KRASSOVSKY", new Ellipsoid(6378245, 6356863.019, "KRASSOVSKY"))
};