
export default function VehiclesPage() {
  Alpine.data('carsTable', () => ({
    cars: [],
    loading: true,

    async init() {
      const res = await fetch('/api/vehicle')
      this.cars = await res.json()
      this.loading = false
    }
  }));

  console.log("hello admin");
}