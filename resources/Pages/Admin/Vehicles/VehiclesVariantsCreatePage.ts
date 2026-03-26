import * as z from "zod";
import Swal from "sweetalert2";
import axios from "axios";

const VariantsPostApiSchema = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

// interface SpecData {
//   vs_id: string
//   vs: string
//   scat_id: string
//   scat: string
//   spec_type_id: string
//   spec_type: string
// }

type VariantsValidation = z.infer<typeof VariantsPostApiSchema>["errors"];

export default function VehiclesVariantsCreatePage() {
  Alpine.data("VariantsCreate", (csrf_token: string = "") => ({
    csrf_token,
    validation: null as VariantsValidation,
    loading: false,
    isValid: true,
    validationMessage: 'Something went wrong',

    async onDefaultToggle(e: Event) {
      const input = e.currentTarget;
      if (!(input instanceof HTMLInputElement)) return;

      // Only warn when turning ON
      if (!input.checked) return;

      const result = await Swal.fire({
        title: "Overwrite default variant?",
        text: "If you set this as default, it will overwrite the current default variant for this vehicle.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, set as default",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#b91c1c",
      });

      if (!result.isConfirmed) {
        input.checked = false;
      }
    },

    async add(e: Event) {
      this.loading = true;

      const form = e.currentTarget;

      if (!(form instanceof HTMLFormElement)) return;

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