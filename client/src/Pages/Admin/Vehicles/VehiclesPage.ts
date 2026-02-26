import * as z from "zod";

const VehiclesApi = z.object({
  pageDetails: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  vehicles: z.array(z.object({
    vehicle_no: z.string(),
    vehicle_title: z.string(),
  }))
})

type VehiclesArray = z.infer<typeof VehiclesApi>["vehicles"];
type pageDetails = z.infer<typeof VehiclesApi>["pageDetails"];

export default function VehiclesPage() {
  console.log(location.pathname)
  Alpine.data('vehiclesData', () => ({
    vehicles: [] as VehiclesArray,
    pageDetails: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as pageDetails,
    loading: true,

    async init(uri = "/api/vehicle") {
      const response = await fetch(uri);
      const result = await VehiclesApi.safeParseAsync(await response.json());

      if (!result.success) {
        console.log(result.error);
      } else {
        this.vehicles = result.data.vehicles;
        this.pageDetails = result.data.pageDetails;
        this.loading = false
      }
    },

    async next(e: Event) {
      const btn = e.currentTarget;

      if (!(btn instanceof HTMLButtonElement)) return;

      this.loading = true;
      this.init(btn.dataset.uri);
    },

    async prev(e: Event) {
      const btn = e.currentTarget;

      if (!(btn instanceof HTMLButtonElement)) return;

      this.loading = true;
      this.init(btn.dataset.uri);
    },

    async search(e: Event) {
      this.loading = true;

      const target = e.currentTarget;

      if (!(target instanceof HTMLInputElement)) return;

      const uri = new URL("/api/vehicle", location.origin);
      uri.searchParams.append("search", target.value);

      this.init(uri.toString());
    }
  }));
}