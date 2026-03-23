import axios from "axios";
import * as z from "zod";
import { PostResponseSchema } from "../../../schemas/api";
import Swal from "sweetalert2";
import Toastify from 'toastify-js';

const VariantSpecificationSchema = z.object({
  scat_no: z.string(),
  scat_title: z.string(),
  spec_title: z.string(),
  variant_no: z.string(),
  vs_no: z.string(),
  vs_value: z.nullable(z.string()),
  vsc_no: z.string()
});

const VariantSpecificationResponseSchema = z.array(
  z.object({
    title: z.string(),
    items: z.array(VariantSpecificationSchema),
  })
);

export default function VariantAddSpecPage() {
  Alpine.data('VariantAddSpec', (csrf_token: string, id: string) => ({
    csrf_token,

    validation: null,
    loading: false,
    updating: false,
    timeout: null as ReturnType<typeof setTimeout> | null,
    controller: null as AbortController | null,

    toast: {
      show: false,
      type: "success" as "success" | "error",
      message: "",
      _timer: null as ReturnType<typeof setTimeout> | null,
    },

    data: [] as z.infer<typeof VariantSpecificationResponseSchema>,

    async init() {
      try {
        const { data } = await axios.get('/api/variants-specifications', { params: { 'variant_id': id } });

        const result = VariantSpecificationResponseSchema.safeParse(data);

        if (!result.success) throw result.error;

        console.log(result.data);
        this.data = result.data
      } catch (error) {
        console.log(error)
      }
    },

    async addSpecification(e: Event) {
      this.loading = true;

      const form = e.currentTarget;

      if (!(form instanceof HTMLFormElement)) return;

      // return console.table(getFormValues(form));

      const uri = form.getAttribute('action') as string;

      try {
        const { data } = await axios.post(uri, form, {
          headers: {
            'Content-Type': 'application/json'
          }
        });

        const result = PostResponseSchema.safeParse(data);

        if (!result.success) {
          throw result.error;
        }

        this.csrf_token = result.data?.csrf_token;

        this.init();

        Swal.fire({
          title: "Added!",
          text: "Vehicle specification has been deleted.",
          icon: "success"
        });
      } catch (error) {
        console.log(error);
      } finally {
        this.loading = false;
      }
    },

    updateSpecification(spec_val: string, uri: string) {
      this.updating = true;
      if (this.timeout) clearTimeout(this.timeout);

      // cancel previous request
      if (this.controller) this.controller.abort();

      this.controller = new AbortController();

      this.timeout = setTimeout(async () => {
        try {
          const { data } = await axios.put(uri, { spec_val, csrf_token: this.csrf_token }, {
            signal: this.controller!.signal
          });

          const result = PostResponseSchema.safeParse(data);

          if (!result.success) throw result.error;

          this.csrf_token = result.data.csrf_token;

          this.showToast("success", "Specification has been updated");
        } catch (error) {
          console.log(error);
        } finally {
          this.updating = false;
        }
      }, 1000);
    },

    async deleteSpecification(vsc: string, vs: string, uri: string) {
      const result = await Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        showLoaderOnConfirm: true,
      })

      if (!result.isConfirmed) return;

      try {
        const response = await axios.delete(uri, {
          data: { vsc, vs, csrf_token: this.csrf_token },
          headers: { 'Content-Type': 'application/json' }
        });

        const result = PostResponseSchema.safeParse(response.data);
        if (!result.success) {
          throw result.error
        }

        this.csrf_token = result.data.csrf_token;
        this.init();

        Swal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success"
        });
        // const response = await axios.delete(uri)
      } catch (error) {
        console.log(error)
      }
    },

    showToast(type: "success" | "error", message: string) {
      if (this.toast._timer) clearTimeout(this.toast._timer);
      this.toast = { ...this.toast, type, message, show: true };
      this.toast._timer = setTimeout(() => (this.toast.show = false), 3000);
    },
  }))
}