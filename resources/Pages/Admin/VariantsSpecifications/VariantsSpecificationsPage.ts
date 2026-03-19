import * as z from "zod";
import Swal from "sweetalert2";
import axios from "axios";
import { getFormValues } from "../../../utils/form.utils";

/**
 * ======================================
 *  Schema Definitions for Variants Specs
 * ======================================
 */

/**
 * API Response Schema for POST Operations on /api/variants-specifications
 * (Used for form submissions: add/update)
 */
const VariantsPostApiSchema = z.object({
  message: z.string(), // Server message
  csrf_token: z.string(), // Updated CSRF token from server, for secure future requests
  errors: z.nullable(z.record(z.string(), z.string())), // Validation errors, if any
});

/** Type for server-side validation errors structure */
type VariantsValidation = z.infer<typeof VariantsPostApiSchema>["errors"];

/**
 * ======================================
 *  Data Structure for Specifications List and Table Rows
 * ======================================
 */

/**
 * Single Specification Entry as shown in the table (fetched from backend)
 */
const VariantSpecificationItemSchema = z.object({
  vs_no: z.string(),        // PK: Variant Specification Record ID
  vs_value: z.string(),            // Value for this spec (e.g. "6-speed")
  spec_title: z.string(),          // Specification Name (e.g. "Transmission")
  spec_no: z.string(),             // FK: Specification ID
  scat_no: z.string(),             // FK: Category ID
  scat_title: z.string(),          // Category Name (e.g. "Powertrain")
  vs_inactive: z.string()
});

/**
 * All specifications for the current variant (array of table rows)
 */
const VariantSpecificationListSchema = z.array(VariantSpecificationItemSchema);

/**
 * ======================================
 *  Data Structure for Submitting New Spec via Form
 * ======================================
 */
const VariantSpecificationFormSchema = z.object({
  spec_type: z.string(),       // Selected specification
  spec_cat: z.string(),       // Selected category
});

/** Array of all specs for the table in this page */
type VariantSpecificationList = z.infer<typeof VariantSpecificationListSchema>;
type VariantSpecificationItem = z.infer<typeof VariantSpecificationItemSchema>;

export default function VariantsSpecificationsPage() {
  Alpine.store("variantSpec", {
    editInput: "",
    editSpecNo: "" as string,
  });

  Alpine.data("VariantsSpecificationsData", (csrf_token: string = "", uri: string = '/', id) => ({
    csrf_token,
    validation: null as VariantsValidation,
    loading: false,
    isValid: true,
    validationMessage: "Something went wrong",
    data: [] as VariantSpecificationList,

    async init() {
      this.loading = true;
      console.log('hello world')
      try {
        const response = await axios.get(`${uri}/${id}`);
        // const result = VariantSpecificationListSchema.safeParse(response.data);
        // console.log(response.data);
        // if (!result.success) {
        //   console.error(result.error);
        //   return;
        // }
        this.data = response.data;

      } catch (error) {
        console.error(error);
      } finally {
        this.loading = false;
      }
    },

    checkIfSpecExists(spec_no: string, scat_no: string) {
      return this.data.some((data: VariantSpecificationItem) => data.spec_no === spec_no && data.scat_no === scat_no);
    },

    async add(e: Event) {
      this.loading = true;

      const form = e.target;
      if (!(form instanceof HTMLFormElement)) return;

      const specifications = VariantSpecificationFormSchema.safeParse(getFormValues(form));
      if (!specifications.success) {
        return console.log(specifications.error);
      }

      if (this.checkIfSpecExists(specifications.data.spec_type, specifications.data.spec_cat)) {
        this.validationMessage = "This spec has already been added.";
        this.isValid = false;
        this.loading = false;
        return;
      }

      const uri = form.getAttribute("action") ?? "api/variants-specifications";

      try {
        const { data } = await axios.post(uri, form, {
          headers: { "Content-Type": "application/json" },
        });

        Swal.fire({
          title: "Added",
          text: data.message,
          icon: "success",
        });

        this.csrf_token = data.csrf_token;
        this.validation = null;
        form.reset();
        this.init();
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = VariantsPostApiSchema.safeParse(data);

          if (!result.success) {
            return console.log(result.error);
          }

          this.validation = result.data.errors;
          this.csrf_token = result.data.csrf_token;
        }
      } finally {
        this.loading = false;
      }
    },

    async edit(vs_id: string, row: VariantSpecificationItem) {
      Alpine.store("variantSpec").editInput = row.vs_value;
      Alpine.store("variantSpec").editSpecNo = row.spec_no;

      this.validation = null;

      const result = await Swal.fire({
        template: "#swal-variant-spec-modal",
        showConfirmButton: false,
      });

      if (!result.isConfirmed) return;

      try {
        // console.table({
        //   vs_id,
        //   csrf_token: this.csrf_token,
        //   vs_value: Alpine.store("variantSpec").editInput,
        //   spec_type: Alpine.store("variantSpec").editSpecNo,
        //   spec_cat: row.scat_no,
        // });


        const response = await axios.put(
          `/api/variants-specifications/${vs_id}`,
          {
            csrf_token: this.csrf_token,
            vs_value: Alpine.store("variantSpec").editInput,
            spec_type: Alpine.store("variantSpec").editSpecNo,
            spec_cat: row.scat_no,
          }
        );


        Swal.fire({
          title: "Updated",
          text: response.data.message,
          icon: "success",
        });
        this.csrf_token = response.data.csrf_token;
        this.init();
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = VariantsPostApiSchema.safeParse(data);

          if (!result.success) {
            return console.log(result.error);
          }

          this.validation = result.data.errors;
          this.csrf_token = result.data.csrf_token;
        }
      }
    },

    async onSwitch(isInactive: string, id: string) {
      try {
        const data = {
          inactive: Number(!Boolean(parseInt(isInactive))),
          csrf_token: this.csrf_token
        }

        const response = await axios.put(`api/variants-specifications/${id}`, data)

        this.csrf_token = response.data.csrf_token;
      } catch (error) {
        if (axios.isAxiosError(error) && error.response?.status === 422) {
          const data = error.response.data;
          const result = VariantsPostApiSchema.safeParse(data);

          if (!result.success) {
            return console.log(result.error);
          }

          this.validation = result.data.errors;
          this.csrf_token = result.data.csrf_token;
        }
      }
    },

    async deleteRow(vs_id: string) {
      const result = await Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      });

      if (!result.isConfirmed) return;

      try {
        const response = await axios.delete(
          `/api/variants-specifications/${vs_id}`,
          {
            data: { csrf_token: this.csrf_token },
          },
        );

        Swal.fire({
          title: "Deleted",
          text: response.data.message,
          icon: "success",
        });

        window.location.reload();
      } catch (error) {
        console.log(error);
      }
    },
  }));
}
