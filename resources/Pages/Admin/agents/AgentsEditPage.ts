import Alpine from 'alpinejs';
import axios from 'axios';
import * as z from "zod";
import Swal from 'sweetalert2';

// ─── API Types ────────────────────────────────────────────────────────────────────

const AgentsUpdateApiSchema = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

type AgentsValidation = z.infer<typeof AgentsUpdateApiSchema>["errors"];


// ─── AgentCreate ──────────────────────────────────────────────────────────────
export default function AgentsEditPage() {
  Alpine.data('AgentCreate', (csrfToken: string, apiEndpoint: string) => ({
    csrf_token: csrfToken,
    api_endpoint: apiEndpoint,

    loading: false,
    validation: null as AgentsValidation,

    async update(event: SubmitEvent) {
      this.loading = true;
      this.validation = null;

      const form = event.currentTarget;

      if (!(form instanceof HTMLFormElement)) return;

      const uri = form.getAttribute("action") as string;

      try {
        const { data } = await axios.put(uri, form, {
          headers: {
            'Content-Type': 'application/json'
          }
        });

        const result = AgentsUpdateApiSchema.safeParse(data);

        if (!result.success) return console.log(result.error);

        Swal.fire({
          title: 'Updated',
          text: result.data.message,
          icon: 'success'
        });

        this.csrf_token = result.data.csrf_token;
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = AgentsUpdateApiSchema.safeParse(data);

          if (!result.success) {
            return console.log(result.error)
          }

          this.validation = result.data.errors;
          this.csrf_token = result.data.csrf_token;
        }
      } finally {
        this.loading = false;
      }
    },
  }));
}

