import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";

export default function SpecificationsPage() {
  Alpine.data('SpecificationsData', (csrf_token: string) => ({
    csrf_token,
    specification: '',
    data: [],
    loading: true,
    errorClass: ["border-red-500", "focus:border-red-500", "focus:ring-red-500"],

    async init() {
      const response = await axios.get('/api/specifications');

      this.data = response.data.specifications;
      console.log(response.data)
    },

    async add() {
      const input = this.$refs['specInput'] as HTMLInputElement;
      input.classList.remove(...this.errorClass);

      try {
        const response = await axios.post('/api/specifications', {
          csrf_token: this.csrf_token,
          specification: this.specification
        });

        this.specification = '';
        Swal.fire({
          title: 'Added',
          text: response.data.message,
          icon: 'success'
        })

        this.init();
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;

          input.classList.add(...this.errorClass);
        }
      }
    }

  }));
}