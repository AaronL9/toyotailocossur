import axios from "axios"
import Swal from "sweetalert2";

export default function Schedule() {
  Alpine.data('schedule', () => ({
    async onSubmitContact(e: Event) {
      const form = e.target;

      if (!(form instanceof HTMLFormElement)) return;

      try {
        const { data } = await axios.post('/api/inquiry', form, {
          headers: {
            'Content-Type': 'application/json'
          }
        })

        const csrf_field = document.getElementById('csrf_field') as HTMLInputElement;
        csrf_field.value = data.csrf_token

        Swal.fire({
          title: 'Success',
          icon: 'success',
          text: 'Your message has been sent',
          showCloseButton: true,
        });

        form.reset();

        console.log(data);

      } catch (error) {

      }
    }
  }))
}