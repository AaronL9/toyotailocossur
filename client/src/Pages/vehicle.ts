import { HSStaticMethods } from "preline";
import Swal from "sweetalert2";

/**
 * Vehicle (single) showroom page: Alpine component for the vehicle detail view.
 * Provides showAccordionModal() to open the SweetAlert2 Preline accordion template.
 */
export default function VehiclePage() {
  Alpine.data("vehiclePage", () => ({

    showAccordionModal(data: any) {

      Alpine.store('fullSpec', data);

      // for (const [key, val] of Object.entries(data)) {
      //   console.log(key, val);
      // }

      Swal.fire({
        template: "#swal-vehicles-accordion",
        showConfirmButton: false,
        customClass: {
          popup: "w-full max-w-2xl bg-white rounded-lg shadow-md p-0 overflow-hidden",
          htmlContainer: "p-2!",
          footer: "border-t border-gray-200 pt-4 pb-4 px-6",
        },

        didOpen: () => {
          HSStaticMethods.autoInit('accordion');
        },
      });
    },
  }));
}
