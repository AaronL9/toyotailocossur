import Alpine from 'alpinejs';
import axios from 'axios';
import * as z from "zod";
import Swal from 'sweetalert2';

// ─── API Types ────────────────────────────────────────────────────────────────────

const AgentsCreateApiSchema = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

type AgentsValidation = z.infer<typeof AgentsCreateApiSchema>["errors"];


// ─── AgentCreate ──────────────────────────────────────────────────────────────
export default function AgentsCreatePage() {
  Alpine.data('AgentCreate', (csrfToken: string, apiEndpoint: string) => ({
    csrf_token: csrfToken,
    api_endpoint: apiEndpoint,

    loading: false,
    validation: null as AgentsValidation,

    async add(event: SubmitEvent) {
      const form = event.target;

      if (!(form instanceof HTMLFormElement)) return;

      this.loading = true;
      this.validation = null;

      try {
        const { data } = await axios.post('/api/agents', form, {
          headers: {
            'Content-Type': 'application/json'
          }
        });

        const result = AgentsCreateApiSchema.safeParse(data);

        if (!result.success) return console.log(result.error);

        Swal.fire({
          title: 'Added',
          text: result.data.message,
          icon: 'success'
        });

        this.csrf_token = result.data.csrf_token;
        form.reset();
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = AgentsCreateApiSchema.safeParse(data);

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

