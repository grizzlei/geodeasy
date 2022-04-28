export class Ellipsoid {
    a; // semi-major axis
    b; // semi-minor axis
    name;
    constructor(a, b, name) {
        this.a = a;
        this.b = b;
        this.name = name;
    }
};