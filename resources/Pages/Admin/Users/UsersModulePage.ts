import Alpine from "alpinejs";
import axios from "axios";
import { z } from "zod";

// ── Schemas ────────────────────────────────────────────────────────────────

const ModuleSchema = z.object({
  mod_no: z.string(),
  mod_title: z.string(),
  mod_icon: z.nullable(z.string()),
  mod_link: z.string(),
  granted: z.boolean(),
});

const UserModulesApiSchema = z.object({
  modules: z.array(ModuleSchema),
});

// ── Types ──────────────────────────────────────────────────────────────────

type ModuleRow = z.infer<typeof ModuleSchema> & {
  saving: boolean;
};

// ── Component ──────────────────────────────────────────────────────────────
export default function UserModulesPage() {
  Alpine.data("UserModulesPage", (csrf_token: string) => ({
    modules: [] as ModuleRow[],
    loading: true,
    toast: {
      show: false,
      type: "success" as "success" | "error",
      message: "",
      _timer: null as ReturnType<typeof setTimeout> | null,
    },
    csrf_token,

    get grantedCount(): number {
      return this.modules.filter((m) => m.granted).length;
    },

    get allGranted(): boolean {
      return this.modules.length > 0 && this.modules.every((m) => m.granted);
    },

    async init() {
      try {
        const { data } = await axios.get(
          `/api/modules/${window.APP.userNo}`
        );

        console.log(data);

        const result = UserModulesApiSchema.safeParse(data);

        if (!result.success) {
          console.log(result.error)
          throw new Error('');
        }

        this.modules = result.data.modules.map((m) => ({ ...m, saving: false }));
      } catch {
        this.showToast("error", "Failed to load modules.");
      } finally {
        this.loading = false;
      }
    },

    async toggleModule(mod: ModuleRow) {
      const grant = !mod.granted;
      mod.granted = grant;
      mod.saving = true;

      try {
        const { data } = await axios.put(`/api/user-module/${window.APP.userNo}`, {
          mod_no: mod.mod_no,
          grant,
          csrf_token: this.csrf_token
        });

        console.log(data);

        this.showToast(
          "success",
          grant
            ? `"${mod.mod_title}" access granted.`
            : `"${mod.mod_title}" access revoked.`
        );

        this.csrf_token = data.csrf_token
      } catch {
        mod.granted = !grant;
        this.showToast("error", "Failed to save. Please try again.");
      } finally {
        mod.saving = false;
      }
    },

    async toggleAll() {
      const grant = !this.allGranted;
      this.modules.forEach((m) => {
        m.granted = grant;
        m.saving = true;
      });

      try {
        await axios.post(
          `/admin/users/${window.APP.userNo}/modules/toggle-all`,
          { grant }
        );

        this.showToast(
          "success",
          grant ? "All modules granted." : "All modules revoked."
        );
      } catch {
        this.modules.forEach((m) => (m.granted = !grant));
        this.showToast("error", "Failed to save. Please try again.");
      } finally {
        this.modules.forEach((m) => (m.saving = false));
      }
    },

    showToast(type: "success" | "error", message: string) {
      if (this.toast._timer) clearTimeout(this.toast._timer);
      this.toast = { ...this.toast, type, message, show: true };
      this.toast._timer = setTimeout(() => (this.toast.show = false), 3000);
    },
  }));
}
// ── Global APP type ────────────────────────────────────────────────────────

declare global {
  interface Window {
    APP: {
      flash: Record<string, string>;
      userNo: string;
    };
  }
}