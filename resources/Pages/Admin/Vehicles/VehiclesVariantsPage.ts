import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";
import { PostResponseSchema } from "../../../schemas/api";

// ─── Schemas ────────────────────────────────────────────────────────────────

const VariantsApiSchema = z.object({
  pagination: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  variants: z.array(
    z.object({
      id: z.string(),
      model: z.string(),
      isdefault: z.boolean(),
      inactive: z.boolean()
      // sub: z.nullable(z.string()),
      // price: z.nullable(z.string()),
      // attrs: z.array(z.string()),
      // active: z.boolean(),
      // uri: z.string(),
    })
  ),
});

const ToggleResponseSchema = z.object({
  csrf_token: z.string(),
  message: z.string(),
});

// ─── Types ───────────────────────────────────────────────────────────────────

type VariantsArray = z.infer<typeof VariantsApiSchema>["variants"];
type pagination = z.infer<typeof VariantsApiSchema>["pagination"];

// ─── Component ───────────────────────────────────────────────────────────────

export default function VehiclesVariantsPage() {
  Alpine.data("variantsData", (csrf_token: string, vehicle_id: string) => ({
    csrf_token,
    vehicle_id,

    variants: [] as VariantsArray,
    pagination: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as pagination,
    loading: true,

    async init(uri = `/api/vehicle/${vehicle_id}`) {
      this.loading = true;

      const response = await fetch(uri);
      const json = await response.json()

      const result = await VariantsApiSchema.safeParseAsync(json);

      if (!result.success) {
        console.error(result.error);
        this.loading = false;
        return;
      }

      this.variants = result.data.variants;
      this.pagination = result.data.pagination;
      this.loading = false;
    },

    async next(e: Event) {
      const btn = e.currentTarget;
      if (!(btn instanceof HTMLButtonElement)) return;
      if (!btn.dataset.uri) return;
      await this.init(btn.dataset.uri);
    },

    async prev(e: Event) {
      const btn = e.currentTarget;
      if (!(btn instanceof HTMLButtonElement)) return;
      if (!btn.dataset.uri) return;
      await this.init(btn.dataset.uri);
    },

    async search(e: Event) {
      const target = e.currentTarget;
      if (!(target instanceof HTMLInputElement)) return;

      const uri = new URL(
        `/api/vehicle/${this.vehicle_id}/variants`,
        location.origin
      );
      uri.searchParams.append("search", target.value);

      await this.init(uri.toString());
    },

    async toggleVariant(id: string, active: boolean) {
      console.log(+!active)
      try {
        const { data } = await axios.patch(
          `/api/variants/${id}`,
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

    async deleteVariant(id: string) {
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
            const { data } = await axios.delete(
              `/api/variants/${id}`,
              { data: { csrf_token: this.csrf_token } }
            );

            const result = PostResponseSchema.safeParse(data);
            if (!result.success) throw result.error;

            this.csrf_token = result.data.csrf_token;
            this.variants = this.variants.filter((v) => v.id !== id);
            this.pagination.total = Math.max(0, this.pagination.total - 1);

            await Swal.fire({
              title: "Deleted!",
              text: result.data.message,
              icon: "success",
            });
          } catch (error) {
            console.error(error);
            Swal.fire({
              title: "Error",
              text: "Something went wrong.",
              icon: "error",
            });
          }
        },
      });
    },
  }));
}