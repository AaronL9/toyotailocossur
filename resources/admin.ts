import "preline";

import "./admin.css";
import "@fortawesome/fontawesome-free/css/all.css";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

window.Alpine = Alpine;
Alpine.plugin(collapse);

import UsersPage from "./Pages/Admin/Users/UsersPage";
import VehiclesPage from "./Pages/Admin/Vehicles/VehiclesPage";
import VehiclesCreatePage from "./Pages/Admin/Vehicles/VehiclesCreatePage";
import VehicleCategoryPage from "./Pages/Admin/Category/VehicleCategoryPage";
import VehiclesCategoryCreatePage from "./Pages/Admin/Category/VehiclesCategoryCreatePage";
import VehiclesCategoryUpdate from "./Pages/Admin/Category/VehicleCategoryUpdatePage";
import VariantsPage from "./Pages/Admin/Variants/VariantsPage";
import VariantsCreatePage from "./Pages/Admin/Variants/VariantsCreatePage";
import VariantsUpdatePage from "./Pages/Admin/Variants/VariantsUpdatePage";
import SpecificationsPage from "./Pages/Admin/Specifications/SpecificationsPage";
import Swal from "sweetalert2";
import AgentsCreatePage from "./Pages/Admin/agents/AgentsCreatePage";
import AgentsPage from "./Pages/Admin/agents/AgentsPage";
import AgentsEditPage from "./Pages/Admin/agents/AgentsEditPage";
import SpecificationsTypePage from "./Pages/Admin/SpecificationType/SpecificationTypePage";
import VariantsSpecificationsPage from "./Pages/Admin/VariantsSpecifications/VariantsSpecificationsPage";
import VehiclesEditPage from "./Pages/Admin/Vehicles/VehiclesEditPage";
import VariantsUploadPhotoPage from "./Pages/Admin/Variants/VariantsUploadPhotoPage";
import InquiryPage from "./Pages/Admin/inquiry/InquiryPage";
import UsersCreatePage from "./Pages/Admin/Users/UsersCreatePage";
import UserModulesPage from "./Pages/Admin/Users/UsersModulePage";
import VariantAddSpecPage from "./Pages/Admin/VariantsSpecifications/VariantAddSpecPage";
import VehiclesVariantsPage from "./Pages/Admin/Vehicles/VehiclesVariantsPage";
import VehiclesVariantsCreatePage from "./Pages/Admin/Vehicles/VehiclesVariantsCreatePage";
import InquiryContactPage from "./Pages/Admin/inquiry/InquiryContactPage";
import InquiryVehiclePage from "./Pages/Admin/inquiry/InquiryVehiclePage";
import InquiryAppointmentPage from "./Pages/Admin/inquiry/InquiryAppointmentPage";

const page = document.body.dataset.page;

const routes: Record<string, () => void> = {
  users: UsersPage,
  "users-create": UsersCreatePage,
  "users-module": UserModulesPage,

  vehicles: VehiclesPage,
  "vehicles-create": VehiclesCreatePage,
  "vehicles-edit": VehiclesEditPage,
  "vehicles-variants": VehiclesVariantsPage,
  "vehicles-variants-create": VehiclesVariantsCreatePage,

  "vehicles-category": VehicleCategoryPage,
  "vehicles-category-create": VehiclesCategoryCreatePage,
  "vehicles-category-update": VehiclesCategoryUpdate,

  variants: VariantsPage,
  "variants-create": VariantsCreatePage,
  "variants-update": VariantsUpdatePage,
  "variants-specifications": VariantsSpecificationsPage,
  "variant-add-spec": VariantAddSpecPage,
  "variants-upload-photo": VariantsUploadPhotoPage,

  specifications: SpecificationsPage,

  agents: AgentsPage,
  "agents-create": AgentsCreatePage,
  "agents-edit": AgentsEditPage,

  "specifications-type": SpecificationsTypePage,

  inquiry: InquiryPage,
  "inquiry-contact": InquiryContactPage,
  "inquiry-vehicle": InquiryVehiclePage,
  "inquiry-appointment": InquiryAppointmentPage,
};

if (page && routes[page]) {
  routes[page]();
}

Alpine.store("Swal", {
  close() {
    Swal.close();
  },

  clickConfirm() {
    Swal.clickConfirm();
  },
});

Alpine.store("helper", {
  formatNumber(value: any) {
    const formatterPH = new Intl.NumberFormat("en-PH", {
      style: "currency",
      currency: "PHP",
    });

    if (isNaN(parseFloat(value))) {
      return formatterPH.format(0);
    }

    return formatterPH.format(value);
  },

  formatDate(value: string) {
    const date = new Date(value);

    const formatted = date.toLocaleDateString("en-US", {
      month: "long",
      day: "numeric",
      year: "numeric",
    });

    return formatted;
  },

  formatTime(value: string) {
    const [h, m, s] = value.split(":");

    const hours = Number(h);
    const minutes = Number(m);
    const seconds = Number(s);

    const date = new Date();
    date.setHours(hours, minutes, seconds);

    return date.toLocaleTimeString("en-US", {
      hour: "numeric",
      minute: "2-digit",
      hour12: true,
    });
  },
});

Alpine.start();
