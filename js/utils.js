import { kEllipsoids } from "./constants.js";

export function getEllipsoidParams(selection)  {
    document.getElementById('iSemiMajor').value = kEllipsoids.get(selection.value).a;
    document.getElementById('iSemiMinor').value = kEllipsoids.get(selection.value).b;
}