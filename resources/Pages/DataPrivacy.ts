// import axios from "axios";
import Swal from "sweetalert2";

function setConsentCookie() {
  const days = 365;
  const maxAge = days * 24 * 60 * 60;

  document.cookie = `privacy_consent=true; max-age=${maxAge}; path=/; SameSite=Lax`;
}

function getConsentCookie() {
  const cookies = document.cookie.split("; ");
  for (let c of cookies) {
    const [key, value] = c.split("=");
    if (key === "privacy_consent") return value;
  }
  return null;
}

/**
 * Privacy consent page: Alpine component for the data privacy modal.
 * Handles scroll tracking, consent checkboxes, and submits acceptance to the CI4 backend.
 */
export default function DataPrivacyPage() {
  Alpine.data("dataPrivacy", () => ({

    // ── State ──────────────────────────────────────────────────────────
    showModal: false,
    accepted: false,
    consentTerms: false,
    consentPrivacy: false,
    hasScrolledToBottom: false,
    scrollProgress: 0,
    isSubmitting: false,

    // ── Computed ───────────────────────────────────────────────────────
    get canAccept(): boolean {
      return this.consentTerms && this.consentPrivacy && this.hasScrolledToBottom;
    },

    // ── Lifecycle ──────────────────────────────────────────────────────
    init() {
      if (getConsentCookie() !== "true") {
        setTimeout(() => {
          this.showModal = true;
          document.body.style.overflow = 'hidden';
        }, 300);
      }
    },

    // ── Handlers ───────────────────────────────────────────────────────
    onScroll(e: Event) {
      const el = e.target as HTMLElement;
      const { scrollTop, scrollHeight, clientHeight } = el;
      const raw = (scrollTop / (scrollHeight - clientHeight)) * 100;

      this.scrollProgress = Math.min(Math.round(raw), 100);

      if (scrollHeight - scrollTop - clientHeight < 40) {
        this.hasScrolledToBottom = true;
      }
    },

    async onAccept() {
      if (!this.canAccept) return;

      this.isSubmitting = true;

      try {
        // const { data } = await axios.post("/privacy/accept", {
        //   consent_terms: this.consentTerms,
        //   consent_privacy: this.consentPrivacy,
        //   accepted_at: new Date().toISOString(),
        // });

        // Refresh CSRF token from response
        // const csrfField = document.querySelector<HTMLInputElement>('input[name="csrf_token"]');
        // if (csrfField && data.csrf_token) {
        //   csrfField.value = data.csrf_token;
        // }

        // ✅ Save cookie instead of localStorage
        setConsentCookie();

        this.showModal = false;

        setTimeout(() => {
          this.accepted = true;
          setTimeout(() => { this.accepted = false; }, 4000);
        }, 350);

      } catch (error) {
        Swal.fire({
          title: "Something went wrong",
          icon: "error",
          text: "We could not record your consent. Please try again.",
          showCloseButton: true,
        });
      } finally {
        this.isSubmitting = false;
      }
    },

    onDecline() {
      this.showModal = false;
      document.body.style.overflow = 'visible';
      // window.location.href = "/";
    },

  }));
}