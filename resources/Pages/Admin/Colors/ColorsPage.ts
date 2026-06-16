import Swal from "sweetalert2";
import { PostResponseSchema } from "../../../schemas/api";
import axios from "axios";


export default function ColorsPage() {
    Alpine.store('colorType', {
        editInput: '',
        editHexVal: '',
    });

    Alpine.data('Colors', (hash: string) => ({
        colorTitle: '',
        colorHex: '',
        data: [],
        search: '',
        csrf_token: hash,

        get filteredData() {
            if (!this.search) return this.data;
            const q = this.search.toLowerCase();
            return this.data.filter((row: any) => row.color_title.toLowerCase().includes(q));
        },

        async init() {
            try {
                const response = await fetch('/api/colors', {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })

                const json = await response.json();

                this.data = json;

                console.log(json)
            } catch (error) {
                console.log(error);
            }
        },

        async edit(row: any) {
            Alpine.store('colorType').editInput = row.color_title;
            Alpine.store('colorType').editHexVal = row.color_hex_value;

            const result = await Swal.fire({
                template: '#swal-color-modal',
                showConfirmButton: false,
            })

            if (!result.isConfirmed) return;

            try {
                const response = await axios.put(`/api/colors/${row.color_no}`, {
                    csrf_token: this.csrf_token,
                    color_title: Alpine.store('colorType').editInput,
                    color_hex_value: Alpine.store('colorType').editHexVal
                });

                console.log(response.data);

                const result = PostResponseSchema.safeParse(response.data);

                if (!result.success) throw result.error;

                this.csrf_token = result.data.csrf_token;
                Swal.fire({
                    title: 'Updated',
                    text: result.data.message,
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

        async deleteRow(color_no: string) {
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
                const response = await axios.delete(`/api/colors/${color_no}`, { data: { csrf_token: this.csrf_token } });

                const result = PostResponseSchema.safeParse(response.data);

                if (!result.success) throw result.error;

                this.csrf_token = result.data.csrf_token

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


    }))
}