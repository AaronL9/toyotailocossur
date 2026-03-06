import * as z from "zod";
import Swal from "sweetalert2";
import axios from "axios";
import { getFormValues } from "../../../utils/form.utils";

const VariantsPostApiSchema = z.object({
  message: z.string(),
  csrf_token: z.string(),
  errors: z.nullable(z.record(z.string(), z.string()))
})

interface SpecData {
  vs_id: string
  vs: string
  scat_id: string
  scat: string
  spec_type_id: string
  spec_type: string
}

type VariantsValidation = z.infer<typeof VariantsPostApiSchema>["errors"];

export default function VariantsSpecificationsPage() {
  Alpine.data("VariantsCreate", (csrf_token: string = "") => ({
    csrf_token,
    validation: null as VariantsValidation,
    loading: false,
    isValid: true,
    validationMessage: 'Something went wrong',

    data: {
      vs_id: '',
      vs: '',
      scat_id: '',
      scat: '',
      spec_type_id: '',
      spec_type: '',
    } as SpecData,

    addedSpecs: [] as SpecData[],

    getSelectedItem() {

    },

    onSpecCatChangeHandler(event: Event) {
      const selectElem = event.target;
      if (!(selectElem instanceof HTMLSelectElement)) return;

      this.data.scat = selectElem.selectedOptions[0].textContent;
      this.data.scat_id = selectElem.selectedOptions[0].value;
    },

    onSpecTypeChangeHandler(event: Event) {
      const selectElem = event.target;
      if (!(selectElem instanceof HTMLSelectElement)) return;

      this.data.spec_type = selectElem.selectedOptions[0].textContent;
      this.data.spec_type_id = selectElem.selectedOptions[0].value;
    },

    addSpec() {
      if (this.$refs['spec_cat_ref'] instanceof HTMLSelectElement) {
        this.$refs['spec_cat_ref'].dispatchEvent(new Event('change'));
      }

      if (this.$refs['spec_type_ref'] instanceof HTMLSelectElement) {
        this.$refs['spec_type_ref'].dispatchEvent(new Event('change'));
      }

      console.log(this.data.vs.trim())
      if (!this.data.vs.trim()) {
        this.validationMessage = 'Please input value';
        this.isValid = false;
        return;
      }

      const newId = `${this.data.scat_id}-${this.data.spec_type_id}`;
      if (this.addedSpecs.some((data: SpecData) => data.vs_id === newId)) {
        this.validationMessage = 'This spec has already been added.';
        return
      }

      this.data.vs_id = newId;
      this.addedSpecs.push({ ...this.data });
      this.data.vs = '';
    },

    removeSpec(id: string) {
      this.addedSpecs = this.addedSpecs.filter((item: SpecData) => item.vs_id !== id)
    },

    async add(e: Event) {
      this.loading = true;

      const form = e.target;
      if (!(form instanceof HTMLFormElement)) return

      const uri = form.getAttribute('action') ?? 'api/variants-specifications';


      try {
        const { data } = await axios.post(uri, form, {
          headers: { "Content-Type": "application/json" }
        })

        Swal.fire({
          title: 'Added',
          text: data.message,
          icon: 'success'
        });

        this.csrf_token = data.csrf_token;
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