import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";
import { PostResponseSchema } from "../../../schemas/api";

const CsrApi = z.object({
  pageDetails: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  data: z.array(
    z.object({
      csr_no: z.number(),
      csr_title: z.string(),
      csr_content: z.string(),
      csr_image: z.nullable(z.string()),
      csr_date: z.string(),
      csr_encode: z.number(),
      csr_encode_date: z.string(),
      csr_inactive: z.number(),
    }),
  ),
});

const ToggleResponseSchema = z.object({
  csrf_token: z.string(),
  message: z.string(),
});

type CsrArray = z.infer<typeof CsrApi>["data"];
type PageDetails = z.infer<typeof CsrApi>["pageDetails"];

export default function CsrPage() {
  Alpine.data("csrData", (csrf_token: string) => ({
    csrf_token,

    csrList: [] as CsrArray,
    pageDetails: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as PageDetails,
    loading: true,

    async init(uri = "/api/csr") {
      const response = await fetch(uri);
      const result = await CsrApi.safeParseAsync(await response.json());

      if (!result.success) {
        console.error(result.error);
      } else {
        this.csrList = result.data.data;
        this.pageDetails = result.data.pageDetails;
        this.loading = false;
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

      const uri = new URL("/api/csr", location.origin);
      uri.searchParams.append("search", target.value);

      this.init(uri.toString());
    },

    async toggleActive(id: number, active: boolean) {
      try {
        const { data } = await axios.patch(`/api/csr/${id}`, {
          inactive: +!active,
          csrf_token: this.csrf_token,
        });

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
          text: "Failed to update CSR status.",
          icon: "error",
        });
      }
    },

    async deleteRow(id: number) {
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
            const { data } = await axios.delete(`/api/csr/${id}`, {
              data: { csrf_token: this.csrf_token },
            });

            const result = PostResponseSchema.safeParse(data);

            if (!result.success) throw result.error;

            this.csrf_token = result.data.csrf_token;
            this.init();

            Swal.fire({
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

    formatDate(dateStr: string | null): string {
      if (!dateStr) return "—";
      return new Date(dateStr).toLocaleDateString("en-PH", {
        year: "numeric",
        month: "short",
        day: "numeric",
      });
    },
  }));
}
