import * as z from "zod";
import Swal from "sweetalert2";
import axios from "axios";

const VehiclePostApi = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

type VehicleValidation = z.infer<typeof VehiclePostApi>["errors"];

export default function VehiclesEditPage() {
  Alpine.data("VehiclesEditPage", (csrf_token: string = "", api: string = '/api/vehicle') => ({
    csrf_token,
    validation: null as VehicleValidation,
    loading: false,

    async updateVehicle(e: Event) {
      this.loading = true;
      const form = e.currentTarget;

      if (!(form instanceof HTMLFormElement)) return;

      try {

        const { data } = await axios.put(api, form, {
          headers: { "Content-Type": "application/json" }
        });

        const result = VehiclePostApi.safeParse(data);

        if (!result.success) return console.log(result.error);

        Swal.fire({
          title: 'Added',
          text: result.data.message,
          icon: 'success'
        });

        this.csrf_token = result.data.csrf_token;
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = VehiclePostApi.safeParse(data);

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