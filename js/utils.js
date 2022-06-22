import { kEllipsoids } from "./constants.js";

export function getEllipsoidParams(selection)  {
    document.getElementById('iSemiMajor').value = kEllipsoids.get(selection.value).a;
    document.getElementById('iSemiMinor').value = kEllipsoids.get(selection.value).b;
}

export function decimalToDMS(angle) {
    var d = Math.floor(angle);
    var m = Math.floor((angle - d) * 60);
    var s = ((angle - d) * 60 - m) * 60;
    return '(' + d + '\u00B0 ' + m + '\' ' + s.toFixed(6) + '")';
}