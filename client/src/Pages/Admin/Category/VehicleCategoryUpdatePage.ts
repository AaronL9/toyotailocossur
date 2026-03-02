import * as z from "zod";
import Swal from "sweetalert2";
import axios from "axios";

const VehicleCategoryPostApi = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

type VehicleValidation = z.infer<typeof VehicleCategoryPostApi>["errors"];

export default function VehiclesCategoryUpdate() {
  Alpine.data("VehicleCategoryCreate", (csrf_token: string = "") => ({
    csrf_token,
    validation: null as VehicleValidation,
    loading: false,

    async update(e: Event) {
      this.loading = true;

      const form = e.currentTarget;

      // Check if the submit event is from form element
      if (!(form instanceof HTMLFormElement)) return;

      const uri = form.getAttribute("action") as string;


      try {
        const { data } = await axios.put(uri, form, {
          method: "PUT",
          headers: { "Content-Type": "application/json" }
        });

        const result = VehicleCategoryPostApi.safeParse(data);

        if (!result.success) return console.log(result.error);

        Swal.fire({
          title: 'Updated',
          text: result.data.message,
          icon: 'success'
        });

        this.csrf_token = result.data.csrf_token;
        this.validation = null;

      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = VehicleCategoryPostApi.safeParse(data);

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