import axios from "axios";
import Swal from "sweetalert2";
import * as z from "zod";


export default function SpecificationsTypePage() {
  Alpine.store('specType', {
    editInput: ''
  });

  Alpine.data('SpecificationsType', (csrf_token: string) => ({
    csrf_token,
    specification: '',
    data: [],
    loading: true,
    errorClass: ["border-red-500", "focus:border-red-500", "focus:ring-red-500"],
    Swal: typeof Swal,

    async init() {
      const response = await axios.get('/api/specifications-type');

      this.data = response.data.specifications;
    },

    async add() {
      const input = this.$refs['specInput'] as HTMLInputElement;
      input.classList.remove(...this.errorClass);

      try {
        const response = await axios.post('/api/specifications-type', {
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
    },

    async edit(spec_title: string, spec_no: string) {
      // Initialize the specification value
      Alpine.store('spec').editInput = spec_title;

      const result = await Swal.fire({
        template: '#swal-spec-modal',
        showConfirmButton: false,
      })

      if (!result.isConfirmed) return;

      try {
        const response = await axios.put(`/api/specifications-type/${spec_no}`, {
          csrf_token: this.csrf_token,
          specification: Alpine.store('spec').editInput
        });

        Swal.fire({
          title: 'Updated',
          text: response.data.message,
          icon: 'success'
        })
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
      })

      if (!result.isConfirmed) return;

      try {
        const response = await axios.delete(`/api/specifications-category/${spec_no}`, { data: { csrf_token: this.csrf_token } });

        Swal.fire({
          title: 'Deleted',
          text: response.data.message,
          icon: 'success'
        })

        this.init();
      } catch (error) {
        console.log(error)
      }
    }
  }));
}