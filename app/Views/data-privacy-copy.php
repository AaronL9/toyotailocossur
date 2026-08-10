<div
  x-data="dataPrivacy()"
  x-init="init()"
>

  <div
    x-cloak
    x-show="showModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-100 bg-primary-950/70 backdrop-blur-sm"
    aria-hidden="true"
  ></div>

  <div
    x-cloak
    x-show="showModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-6 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 scale-95"
    class="fixed inset-0 z-101 flex items-center justify-center p-4"
    role="dialog"
    aria-modal="true"
    aria-labelledby="privacy-title"
  >
    <div class="w-full max-w-xl bg-white border border-primary-200 rounded-2xl shadow-2xl flex flex-col overflow-hidden max-h-[90dvh]">

      <div class="flex items-start gap-4 px-6 py-5 border-b border-primary-200">
        <div class="shrink-0 flex items-center justify-center size-11 rounded-xl bg-accent-50 text-accent-600 mt-0.5">
          <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round">
            <path d="M12 2L3 7V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V7L12 2Z"/>
            <path d="M9 12L11 14L15 10" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-[10.5px] font-semibold tracking-widest uppercase text-accent-600 mb-0.5">
            Your Privacy Matters
          </p>
          <h2 id="privacy-title" class="text-lg font-semibold text-primary-900 leading-snug">
            Data Privacy Notice
          </h2>
          <p class="text-[12px] text-secondary-500 mt-1 leading-snug">
            Please read this notice carefully before using our services.
          </p>
        </div>
        <div class="shrink-0 flex items-center gap-1.5 mt-1">
          <span
            class="inline-flex items-center justify-center size-6 rounded-full text-[11px] font-semibold transition-colors duration-200"
            :class="hasScrolledToBottom ? 'bg-secondary-700 text-white' : 'bg-primary-100 text-primary-500'"
          >1</span>
          <span class="w-3 h-px bg-primary-200"></span>
          <span
            class="inline-flex items-center justify-center size-6 rounded-full text-[11px] font-semibold transition-colors duration-200"
            :class="(consentTerms && consentPrivacy) ? 'bg-secondary-700 text-white' : 'bg-primary-100 text-primary-500'"
          >2</span>
          <span class="w-3 h-px bg-primary-200"></span>
          <span
            class="inline-flex items-center justify-center size-6 rounded-full text-[11px] font-semibold transition-colors duration-200"
            :class="canAccept ? 'bg-accent-600 text-white' : 'bg-primary-100 text-primary-500'"
          >3</span>
        </div>
      </div>

      <div class="h-0.5 bg-primary-100 shrink-0">
        <div
          class="h-full bg-accent-500 rounded-r-full transition-[width] duration-100"
          :style="{ width: scrollProgress + '%' }"
        ></div>
      </div>

      <div
        class="flex-1 overflow-y-auto px-6 py-5 space-y-5 [scrollbar-width:thin]"
        @scroll="onScroll"
        x-ref="scrollContainer"
      >

        <div class="p-4 rounded-xl bg-secondary-50 border border-secondary-100 text-[13px] text-secondary-700 leading-relaxed">
          This Privacy Notice explains how <strong class="font-semibold text-primary-800">Toyota</strong>
          collects, uses, and protects the personal information you share with us when you use our
          website — whether you are inquiring about a vehicle, requesting a service, or reaching out
          to our team. We are committed to handling your data with transparency and care.
        </div>

        <div class="pb-5 border-b border-primary-100">
          <div class="flex items-center gap-2 mb-2.5">
            <span class="inline-flex items-center justify-center size-5 rounded-full bg-accent-100 text-accent-700 text-[10px] font-bold shrink-0">1</span>
            <p class="text-[11px] font-semibold text-primary-800 tracking-wide uppercase">What Information We Collect</p>
          </div>
          <p class="text-[13px] text-secondary-600 leading-relaxed mb-3">
            Depending on how you interact with our website, we may collect the following personal information:
          </p>
          <div class="mb-3 rounded-lg border border-primary-100 overflow-hidden">
            <div class="px-3.5 py-2 bg-primary-50 border-b border-primary-100">
              <p class="text-[11px] font-semibold text-primary-700 uppercase tracking-wide flex items-center gap-1.5">
                <svg class="size-3.5 text-accent-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                  <rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
                Vehicle Information
              </p>
            </div>
            <div class="px-3.5 py-3 space-y-1.5 text-[13px] text-secondary-600">
              <div class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0"></span> Car model and variant</div>
              <div class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0"></span> Manufacturing year</div>
              <div class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0"></span> Plate number</div>
              <div class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0"></span> Current mileage</div>
            </div>
          </div>
          <div class="rounded-lg border border-primary-100 overflow-hidden">
            <div class="px-3.5 py-2 bg-primary-50 border-b border-primary-100">
              <p class="text-[11px] font-semibold text-primary-700 uppercase tracking-wide flex items-center gap-1.5">
                <svg class="size-3.5 text-accent-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
                Personal & Contact Information
              </p>
            </div>
            <div class="px-3.5 py-3 space-y-1.5 text-[13px] text-secondary-600">
              <div class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0"></span> Full name</div>
              <div class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0"></span> Mobile number</div>
              <div class="flex items-center gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0"></span> Email address</div>
            </div>
          </div>
        </div>

        <div class="pb-5 border-b border-primary-100">
          <div class="flex items-center gap-2 mb-2.5">
            <span class="inline-flex items-center justify-center size-5 rounded-full bg-accent-100 text-accent-700 text-[10px] font-bold shrink-0">2</span>
            <p class="text-[11px] font-semibold text-primary-800 tracking-wide uppercase">Why We Collect This Information</p>
          </div>
          <p class="text-[13px] text-secondary-600 leading-relaxed mb-2.5">
            We collect your information solely to provide you with relevant Toyota services. Specifically, we use it to:
          </p>
          <ul class="space-y-2 text-[13px] text-secondary-600">
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> Process your vehicle inquiry or trade-in assessment, including matching your car details to the most suitable service or offer.</li>
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> Allow our sales or service representatives to contact you via phone or email regarding your inquiry.</li>
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> Respond to general questions and messages submitted through our Contact Us form.</li>
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> Improve the overall experience and relevance of our website for Toyota owners and potential customers.</li>
          </ul>
          <p class="text-[13px] text-secondary-600 leading-relaxed mt-2.5">
            We will never use your information for unrelated marketing purposes without your explicit permission.
          </p>
        </div>

        <div class="pb-5 border-b border-primary-100">
          <div class="flex items-center gap-2 mb-2.5">
            <span class="inline-flex items-center justify-center size-5 rounded-full bg-accent-100 text-accent-700 text-[10px] font-bold shrink-0">3</span>
            <p class="text-[11px] font-semibold text-primary-800 tracking-wide uppercase">How We Share Your Information</p>
          </div>
          <p class="text-[13px] text-secondary-600 leading-relaxed">
            Toyota does <strong class="font-semibold text-primary-800">not sell, rent, or trade</strong> your personal information to any third party.
            Your data may be accessed only by authorized Toyota staff directly involved in handling your inquiry.
            In cases required by law or regulation, we may disclose information to relevant government authorities.
          </p>
        </div>

        <div class="pb-5 border-b border-primary-100">
          <div class="flex items-center gap-2 mb-2.5">
            <span class="inline-flex items-center justify-center size-5 rounded-full bg-accent-100 text-accent-700 text-[10px] font-bold shrink-0">4</span>
            <p class="text-[11px] font-semibold text-primary-800 tracking-wide uppercase">How Long We Keep Your Data</p>
          </div>
          <p class="text-[13px] text-secondary-600 leading-relaxed">
            We retain your personal information only for as long as necessary to fulfill the purpose for which it was collected
            — typically until your inquiry has been resolved or the relevant service has been completed.
            After this period, your data will be securely deleted or anonymized.
            You may request earlier deletion at any time by contacting us.
          </p>
        </div>

        <div class="pb-5 border-b border-primary-100">
          <div class="flex items-center gap-2 mb-2.5">
            <span class="inline-flex items-center justify-center size-5 rounded-full bg-accent-100 text-accent-700 text-[10px] font-bold shrink-0">5</span>
            <p class="text-[11px] font-semibold text-primary-800 tracking-wide uppercase">Your Rights</p>
          </div>
          <p class="text-[13px] text-secondary-600 leading-relaxed mb-2.5">
            As the owner of your personal data, you have the right to:
          </p>
          <ul class="space-y-2 text-[13px] text-secondary-600">
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> <span><strong class="font-medium text-primary-700">Access</strong> — request a copy of the personal information we hold about you.</span></li>
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> <span><strong class="font-medium text-primary-700">Correction</strong> — ask us to update or correct any inaccurate information.</span></li>
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> <span><strong class="font-medium text-primary-700">Deletion</strong> — request the removal of your personal data from our records.</span></li>
            <li class="flex items-start gap-2"><span class="size-1.5 rounded-full bg-accent-400 shrink-0 mt-1.5"></span> <span><strong class="font-medium text-primary-700">Withdraw consent</strong> — opt out at any time, without affecting the lawfulness of prior processing.</span></li>
          </ul>
          <p class="text-[13px] text-secondary-600 leading-relaxed mt-2.5">
            To exercise any of these rights, please reach out to us at
            <a href="mailto:privacy@toyota.com" class="text-info-600 hover:text-info-700 underline underline-offset-2 transition-colors font-medium">privacy@toyota.com</a>.
            We will respond within a reasonable time frame.
          </p>
        </div>

        <div class="pb-5 border-b border-primary-100">
          <div class="flex items-center gap-2 mb-2.5">
            <span class="inline-flex items-center justify-center size-5 rounded-full bg-accent-100 text-accent-700 text-[10px] font-bold shrink-0">6</span>
            <p class="text-[11px] font-semibold text-primary-800 tracking-wide uppercase">How We Protect Your Data</p>
          </div>
          <p class="text-[13px] text-secondary-600 leading-relaxed">
            We take the security of your information seriously. Your data is transmitted over secure,
            encrypted connections (HTTPS/TLS) and stored in access-controlled systems.
            Only authorized Toyota personnel may access your records, and only when necessary to
            handle your inquiry. We regularly review our practices to ensure your data remains protected.
          </p>
        </div>

        <div>
          <div class="flex items-center gap-2 mb-2.5">
            <span class="inline-flex items-center justify-center size-5 rounded-full bg-accent-100 text-accent-700 text-[10px] font-bold shrink-0">7</span>
            <p class="text-[11px] font-semibold text-primary-800 tracking-wide uppercase">Changes to This Notice</p>
          </div>
          <p class="text-[13px] text-secondary-600 leading-relaxed">
            We may update this Privacy Notice from time to time to reflect changes in our services or
            applicable law. When we do, we will revise the effective date at the top of the page.
            We encourage you to review this notice periodically.
            Continued use of our website after any update constitutes your acceptance of the revised notice.
          </p>
          <p class="text-[12px] text-primary-400 mt-3">Effective date: <?= date('F d, Y') ?></p>
        </div>

      </div>

      <div class="px-6 py-4 bg-primary-50 border-t border-primary-200 space-y-2.5">
        <label
          class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all duration-150 select-none"
          :class="consentTerms ? 'border-accent-300 bg-accent-50 ring-1 ring-accent-200' : 'border-primary-200 bg-white hover:border-primary-300'"
        >
          <input
            type="checkbox"
            x-model="consentTerms"
            class="mt-0.5 shrink-0 size-4 rounded border-primary-300 checked:bg-accent-600 checked:border-accent-600 focus:ring-2 focus:ring-accent-400 focus:ring-offset-0 cursor-pointer transition-colors"
          >
          <span class="text-[13px] leading-relaxed text-secondary-700">
            I have read and understood this Data Privacy Notice and agree to Toyota's
            <a href="/terms" target="_blank" class="text-accent-600 font-medium hover:underline underline-offset-2">Terms of Service</a>.
          </span>
        </label>

        <label
          class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all duration-150 select-none"
          :class="consentPrivacy ? 'border-accent-300 bg-accent-50 ring-1 ring-accent-200' : 'border-primary-200 bg-white hover:border-primary-300'"
        >
          <input
            type="checkbox"
            x-model="consentPrivacy"
            class="mt-0.5 shrink-0 size-4 rounded border-primary-300 checked:bg-accent-600 checked:border-accent-600 focus:ring-2 focus:ring-accent-400 focus:ring-offset-0 cursor-pointer transition-colors"
          >
          <span class="text-[13px] leading-relaxed text-secondary-700">
            I consent to Toyota collecting and using my vehicle details and contact information
            for the purposes described above.
          </span>
        </label>
      </div>

      <div class="px-6 pt-3 pb-5 border-t border-primary-200 space-y-3">
        <div
          x-show="!hasScrolledToBottom"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
        >
          <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-[11px] font-medium bg-primary-100 text-primary-500 animate-pulse">
            <svg class="size-3" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
              <path d="M8 3V13M8 13L4 9M8 13L12 9"/>
            </svg>
            Scroll down to read the full notice
          </span>
        </div>

        <div class="flex items-center justify-between gap-2">
          <p class="text-[11px] text-primary-400 hidden sm:block">Steps: Read → Agree → Submit</p>
          <div class="flex items-center gap-2 ms-auto">
            <button
              type="button"
              @click="onDecline()"
              :disabled="isSubmitting"
              class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-primary-200 bg-white text-primary-700 shadow-sm hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-300 disabled:opacity-50 disabled:pointer-events-none transition-colors"
            >
              Decline
            </button>
            <button
              type="button"
              @click="onAccept()"
              :disabled="!canAccept || isSubmitting"
              class="py-2 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-accent-400 focus:ring-offset-1 transition-all duration-200 disabled:opacity-40 disabled:pointer-events-none"
              :class="canAccept ? 'bg-accent-600 text-white hover:bg-accent-700 hover:-translate-y-px shadow-sm hover:shadow-lg' : 'bg-primary-300 text-white'"
            >
              <template x-if="!isSubmitting">
                <span class="flex items-center gap-2">
                  <svg class="size-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 1.5A6.5 6.5 0 1 0 14.5 8"/><path d="M5 8L7 10L11 6"/>
                  </svg>
                  I Agree & Continue
                </span>
              </template>
              <template x-if="isSubmitting">
                <span class="flex items-center gap-2">
                  <svg class="animate-spin size-4 shrink-0" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-opacity=".25" stroke-width="2"/>
                    <path d="M8 2a6 6 0 0 1 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                  Processing…
                </span>
              </template>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div
    x-cloak
    x-show="accepted"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-3"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-3"
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[60] inline-flex items-center gap-2.5 py-3 px-5 rounded-full bg-primary-900 text-white text-sm font-medium shadow-xl whitespace-nowrap ring-1 ring-white/10"
  >
    <svg class="size-4 text-green-400 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
      <circle cx="8" cy="8" r="7"/>
      <path d="M5 8L7 10L11 5.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Thank you. Your consent has been recorded.
  </div>

</div>