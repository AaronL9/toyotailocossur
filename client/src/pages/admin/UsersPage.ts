
export default function UsersPage() {
  console.log("hello world");
  Alpine.data('carsTable', () => ({
    cars: [],
    loading: true,

    async init() {
      const res = await fetch('/api/vehicle')
      this.cars = await res.json()
      this.loading = false
    }
  }));
}