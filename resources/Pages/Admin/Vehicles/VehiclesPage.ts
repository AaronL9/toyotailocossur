import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";
import { PostResponseSchema } from "../../../schemas/api";

const VehiclesApi = z.object({
  pageDetails: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  vehicles: z.array(z.object({
    id: z.string(),
    name: z.string(),
    categories: z.array(z.string()),
    tagline: z.nullable(z.string()),
    uri: z.string(),
    inactive: z.boolean(),
  }))
})

const ToggleResponseSchema = z.object({
  csrf_token: z.string(),
  message: z.string(),
});

type VehiclesArray = z.infer<typeof VehiclesApi>["vehicles"];
type pageDetails = z.infer<typeof VehiclesApi>["pageDetails"];

export default function VehiclesPage() {
  Alpine.data('vehiclesData', (csrf_token: string) => ({
    csrf_token,

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
    },

    async toggleActive(id: string, active: boolean) {
      console.log(+!active)
      try {
        const { data } = await axios.patch(
          `/api/vehicle/${id}`,
          { inactive: +!active, csrf_token: this.csrf_token }
        );

        const result = ToggleResponseSchema.safeParse(data);
        if (!result.success) throw result.error;

        this.csrf_token = result.data.csrf_token;
        Swal.fire({
          title: "Success",
          text: result.data.message,
          icon: "success",
        });
      } catch (error) {
        console.error(error);

        await Swal.fire({
          title: "Error",
          text: "Failed to update variant status.",
          icon: "error",
        });
      }
    },

    async deleteRow(id: string) {
      await Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        showLoaderOnConfirm: true,
        preConfirm: async () => {
          try {
            const { data } = await axios.delete(`/api/vehicle/${id}`, { data: { csrf_token: this.csrf_token } });

            const result = PostResponseSchema.safeParse(data);

            if (!result.success) throw result.error;

            this.csrf_token = result.data.csrf_token;
            this.init();

            Swal.fire({
              title: "Deleted!",
              text: result.data.message,
              icon: "success"
            });
          } catch (error) {
            console.log(error);
            Swal.fire({
              title: "Error",
              text: "Something went wrong",
              icon: "error"
            });
          }
        }
      });
    }
  }));
}