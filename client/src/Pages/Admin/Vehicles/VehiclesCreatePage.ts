import * as z from "zod";
import Swal from "sweetalert2";
import { getFormValues } from "../../../utils/form.utils";
import axios, { Axios } from "axios";

const VehicleSchema = z.object({
  csrf_token: z.string(),
  tagline: z.string(),
  title: z.string(),
  "vehicle-category": z.string()
})

const VehiclePostApi = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

type VehicleValidation = z.infer<typeof VehiclePostApi>["errors"];

export default function VehiclesCreatePage() {
  Alpine.data("VehicleCreatePage", (csrf_token: string = "") => ({
    csrf_token,
    validation: null as VehicleValidation,

    async addVehicle(e: Event) {
      const form = e.currentTarget;

      if (!(form instanceof HTMLFormElement)) return;

      try {
        const { data } = await axios.post("/api/vehicle", form, {
          headers: { "Content-Type": "application/json" }
        });

        Swal.fire({
          title: 'Added',
          text: "added",
          icon: 'success'
        });
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const res = error.response.data;
          console.log(res);
        }
      }

      // const data = getFormValues(form);
      // const result = VehicleSchema.safeParse(data);

      // if (!result.success) return console.log(result.error);

      // axios.post('/api/vehicle', result.data).then((response) => {
      //   console.log(response.data);
      // }).catch((reason) => {
      //   console.log(reason.response);
      // });

      // const res = await fetch("/api/vehicle", {
      //   method: "POST",
      //   headers: {
      //     "Content-Type": "application/json"
      //   },
      //   body: JSON.stringify(result.data),
      // });

      // const json = await res.json();
      // console.log(json);

      // try {
      //   const res = await fetch("/api/vehicle", {
      //     method: "POST",

      //     body: JSON.stringify(result.data),
      //   });

      //   const json = await res.json();

      //   // Validate data from an API
      //   const jsonResult = VehiclePostApi.safeParse(json);
      //   if (!jsonResult.success) return console.log(jsonResult.error);

      //   if (!res.ok) {
      //     switch (res.status) {
      //       case 422:
      //         this.validation = jsonResult.data.errors;
      //         this.csrf_token = jsonResult.data.csrf_token;
      //         break;
      //     }


      //     throw new Error(res.statusText);
      //   }

      //   Swal.fire({
      //     title: 'Added',
      //     text: jsonResult.data.message,
      //     icon: 'success'
      //   });
      // } catch (error) {
      //   if (error instanceof Error) {
      //     console.log(error.message);
      //   }
      // }
    },
  }));
}