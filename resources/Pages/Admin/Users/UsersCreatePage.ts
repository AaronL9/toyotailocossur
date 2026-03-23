export default function UsersCreatePage() {
  Alpine.data("UsersCreatePage", () => ({
    // ── Password visibility ────────────────────────────────────────
    showPassword: false as boolean,
    showConfirm: false as boolean,

    // ── Form state ─────────────────────────────────────────────────
    submitting: false as boolean,

    // ── Form submit ────────────────────────────────────────────────
    async onSubmit(e: Event): Promise<void> {
      if (this.submitting) return;

      const form = e.currentTarget as HTMLFormElement;

      this.submitting = true;
      try {
        form.submit();
      } catch {
        // Re-enable the button if submit is blocked
        this.submitting = false;
      }
    },
  }));
}