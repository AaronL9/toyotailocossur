import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";

const VehiclesCategoryApi = z.object({
  pagination: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  vehicle_categories: z.array(z.object({
    cat_no: z.string(),
    cat_title: z.string(),
    cat_order: z.string()
  }))
})

const VehicleCategoryDeleteApi = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

type VehiclesCategory = z.infer<typeof VehiclesCategoryApi>["vehicle_categories"];
type Pagination = z.infer<typeof VehiclesCategoryApi>["pagination"];

export default function VehicleCategoryPage() {
  Alpine.data('VehicleCategoryTable', (csrf_token: string = '') => ({
    data: [] as VehiclesCategory,
    pagination: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as Pagination,
    loading: true,
    csrf_token,

    async init(uri = "/api/vehicles-category") {
      axios.get(uri)
        .then((res) => {
          const result = VehiclesCategoryApi.safeParse(res.data);

          if (!result.success) {
            console.log(result.error);
          } else {
            this.data = result.data.vehicle_categories;
            this.pagination = result.data.pagination;
            this.loading = false
          }
        })
        .catch((error) => {
          console.log(error);
        });
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

      const uri = new URL("/api/vehicles-category", location.origin);
      uri.searchParams.append("search", target.value);

      this.init(uri.toString());
    },

    async deleteRow(id: null | string) {
      Swal.fire({
        title: `Are you sure?`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          axios({
            method: 'delete',
            url: `/api/vehicles-category/${id}`,
            data: {
              csrf_token: this.csrf_token
            }
          }).then((response) => {
            const result = VehicleCategoryDeleteApi.safeParse(response.data)

            if (!result.success) {
              return console.log(result.error);
            }

            this.csrf_token = result.data.csrf_token;
            this.init();

            Swal.fire({
              title: "Deleted!",
              text: "Catgory has been deleted.",
              icon: "success"
            });
          }).catch((error) => {
            console.log(error)
          })
        }
      });
    }
  }));
}