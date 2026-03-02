import * as z from "zod";
import Swal from "sweetalert2";
import axios from "axios";

const VariantsPostApiSchema = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

type VariantsValidation = z.infer<typeof VariantsPostApiSchema>["errors"];

export default function VariantsCreatePage() {
  Alpine.data("VariantsCreate", (csrf_token: string = "") => ({
    csrf_token,
    validation: null as VariantsValidation,
    loading: false,

    async add(e: Event) {
      this.loading = true;

      const form = e.currentTarget;

      if (!(form instanceof HTMLFormElement)) return;

      // const formData = new FormData(form);
      // const json = Object.fromEntries(formData.entries());

      try {
        const { data } = await axios.post("/api/variants", form, {
          headers: { "Content-Type": "application/json" }
        });

        const result = VariantsPostApiSchema.safeParse(data);

        if (!result.success) return console.log(result.error);

        Swal.fire({
          title: 'Added',
          text: result.data.message,
          icon: 'success'
        });

        this.csrf_token = result.data.csrf_token;
        this.validation = null;
        form.reset();
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = VariantsPostApiSchema.safeParse(data);

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