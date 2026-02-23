import VehicleModelCard from "../components/VehicleModelCard";

export default function Showroom() {
  (async function () {
    const res = await fetch("/api/vehicle");
    const json = await res.json();

    const data = Array.from(json.data.vehicle);

    const elem = document.getElementById("vehicle-cat-container");
    if (elem instanceof HTMLElement) {
      elem.replaceChildren();

      data.forEach((val) => {
        elem.append(VehicleModelCard(val));
      })
    }
  })()
} 