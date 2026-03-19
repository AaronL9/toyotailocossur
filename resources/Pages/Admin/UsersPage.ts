import * as z from "zod";

const Vehicles = z.object({
  pageDetails: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  data: z.array(z.object({
    vehicle_no: z.string(),
    vehicle_title: z.string(),
  }))
})

export default function UsersPage() {
  (async function () {
    const response = await fetch("/api/vehicle");
    const result = await Vehicles.safeParseAsync(await response.json());

    if (!result.success) {
      console.log(result.error);
    } else {
      console.log(result.data)
    }
  })();

  Alpine.data('carsTable', () => ({
    cars: [],
    loading: true,

    async init() {
      const res = await fetch('/api/vehicle')
      const json = await res.json();
      this.cars = json.data;
      this.loading = false
    }
  }));
}