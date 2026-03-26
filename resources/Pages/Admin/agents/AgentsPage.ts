import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";

const AgentsIndexApi = z.object({
  pagination: z.object({
    total: z.number(),
    currentPage: z.number(),
    pageCount: z.number(),
    next: z.nullable(z.string()),
    previous: z.nullable(z.string()),
  }),
  agents: z.array(z.object({
    agent_no: z.string(),
    agent_lname: z.string(),
    agent_fname: z.string(),
    agent_mname: z.nullable(z.string()),
    agent_contact: z.nullable(z.string()),
    agent_email: z.nullable(z.string()),
    agent_inactive: z.string()
  }))
})

const AgentsDeleteApi = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

const ToggleResponseSchema = z.object({
  csrf_token: z.string(),
  message: z.string(),
});

type Agents = z.infer<typeof AgentsIndexApi>["agents"];
type Pagination = z.infer<typeof AgentsIndexApi>["pagination"];

export default function AgentsPage() {
  Alpine.data('AgentsTable', (csrf_token: string = '') => ({
    data: [] as Agents,
    pagination: {
      total: 0,
      currentPage: 0,
      pageCount: 0,
      next: null,
      previous: null,
    } as Pagination,
    loading: true,
    csrf_token,

    async init(uri = '/api/agents') {
      try {
        const response = await axios.get(uri);

        const result = AgentsIndexApi.safeParse(response.data);

        if (!result.success) {
          console.log(result.error);
        } else {
          this.data = result.data.agents;
          this.pagination = result.data.pagination;
          this.loading = false
        }

        console.log(response);
      } catch (error) {
        console.error(error);
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

      const uri = new URL("/api/agents", location.origin);
      uri.searchParams.append("search", target.value);

      this.init(uri.toString());
    },

    async toggleActive(id: string, active: boolean) {
      try {
        const { data } = await axios.patch(
          `/api/agents/${id}`,
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
          text: "Failed to update agent status.",
          icon: "error",
        });
      }
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
            const result = AgentsDeleteApi.safeParse(response.data)

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