import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";
import { PostResponseSchema } from "../../../schemas/api";

// ─── API Types ────────────────────────────────────────────────────────────────────

const SpecPostApi = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

export default function SpecificationsPage() {
  Alpine.store('spec', {
    editInput: ''
  });

  Alpine.data('SpecificationsData', (csrf_token: string) => ({
    csrf_token,
    category: '',
    search: '',
    data: [],
    loading: true,
    errorClass: ["border-red-500", "focus:border-red-500", "focus:ring-red-500"],
    Swal: typeof Swal,

    get filteredData() {
      if (!this.search) return this.data;
      const q = this.search.toLowerCase();
      return this.data.filter((row: any) => row.scat_title.toLowerCase().includes(q));
    },

    async init() {
      const response = await axios.get('/api/specifications-category');
      this.data = response.data.specifications;
    },

    async add() {
      const input = this.$refs['specInput'] as HTMLInputElement;
      input.classList.remove(...this.errorClass);

      try {
        const response = await axios.post('/api/specifications-category', {
          csrf_token: this.csrf_token,
          category: this.category
        });

        const result = SpecPostApi.safeParse(response.data);

        if (!result.success) {
          return console.log(result.error);
        }

        Swal.fire({
          title: 'Added',
          text: result.data.message,
          icon: 'success'
        });

        this.category = '';
        this.csrf_token = result.data.csrf_token;
        this.init();
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          input.classList.add(...this.errorClass);
        }
      }
    },

    async edit(spec_title: string, spec_no: string) {
      Alpine.store('spec').editInput = spec_title;

      const result = await Swal.fire({
        template: '#swal-spec-modal',
        showConfirmButton: false,
      });

      if (!result.isConfirmed) return;

      try {
        const response = await axios.put(`/api/specifications-category/${spec_no}`, {
          csrf_token: this.csrf_token,
          category: Alpine.store('spec').editInput
        });

        const result = PostResponseSchema.safeParse(response.data);

        if (!result.success) throw result.error;

        this.csrf_token = result.data.csrf_token;
        Swal.fire({
          title: 'Updated',
          text: result.data.message,
          icon: 'success'
        });
        this.init();
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          console.log(data);
        }
      }
    },

    async deleteRow(spec_no: string) {
      const result = await Swal.fire({
        title: `Are you sure?`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      });

      if (!result.isConfirmed) return;

      try {
        const response = await axios.delete(`/api/specifications-category/${spec_no}`, { data: { csrf_token: this.csrf_token } });

        const result = PostResponseSchema.safeParse(response.data);

        if (!result.success) throw result.error;

        this.csrf_token = result.data.csrf_token;
        Swal.fire({
          title: 'Deleted',
          text: result.data.message,
          icon: 'success'
        });

        this.init();
      } catch (error) {
        console.log(error);
      }
    }
  }));
}