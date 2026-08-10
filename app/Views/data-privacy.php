<div
  x-data="dataPrivacy()"
  x-init="init()">

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
    aria-hidden="true"></div>

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
    aria-labelledby="privacy-title">
    <div class="w-full max-w-xl bg-white border border-primary-200 rounded-2xl shadow-2xl flex flex-col overflow-hidden max-h-[90dvh]">

      <div class="flex items-start gap-4 px-6 py-5 border-b border-primary-200">
        <div class="shrink-0 flex items-center justify-center size-11 rounded-xl bg-accent-50 text-accent-600 mt-0.5">
          <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round">
            <path d="M12 2L3 7V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V7L12 2Z" />
            <path d="M9 12L11 14L15 10" stroke-linecap="round" />
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
        <!-- <div class="shrink-0 flex items-center gap-1.5 mt-1">
          <span
            class="inline-flex items-center justify-center size-6 rounded-full text-[11px] font-semibold transition-colors duration-200"
            :class="hasScrolledToBottom ? 'bg-secondary-700 text-white' : 'bg-primary-100 text-primary-500'">1</span>
          <span class="w-3 h-px bg-primary-200"></span>
          <span
            class="inline-flex items-center justify-center size-6 rounded-full text-[11px] font-semibold transition-colors duration-200"
            :class="(consentTerms && consentPrivacy) ? 'bg-secondary-700 text-white' : 'bg-primary-100 text-primary-500'">2</span>
          <span class="w-3 h-px bg-primary-200"></span>
          <span
            class="inline-flex items-center justify-center size-6 rounded-full text-[11px] font-semibold transition-colors duration-200"
            :class="canAccept ? 'bg-accent-600 text-white' : 'bg-primary-100 text-primary-500'">3</span>
        </div> -->
      </div>

      <div class="h-0.5 bg-primary-100 shrink-0">
        <div
          class="h-full bg-accent-500 rounded-r-full transition-[width] duration-100"
          :style="{ width: scrollProgress + '%' }"></div>
      </div>

      <div
        class="flex-1 overflow-y-auto px-6 py-5 space-y-5 [scrollbar-width:thin]"
        @scroll="onScroll"
        x-ref="scrollContainer">

        <div class="p-4 rounded-xl bg-secondary-50 border border-secondary-100 text-[13px] text-secondary-700 leading-relaxed">
          Toyota Ilocos Sur is committed to ensuring the confidentiality of your information under Republic Act No. 10173 or the "Data Privacy Act of 2012" and will exert reasonable efforts to protect against its unauthorized use or disclosure.
        </div>
      </div>

      <div class="px-6 py-4 bg-primary-50 border-t border-primary-200 space-y-2.5">
        <label
          class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all duration-150 select-none"
          :class="consentTerms ? 'border-accent-300 bg-accent-50 ring-1 ring-accent-200' : 'border-primary-200 bg-white hover:border-primary-300'">
          <input
            type="checkbox"
            x-model="consentTerms"
            class="mt-0.5 shrink-0 size-4 rounded border-primary-300 checked:bg-accent-600 checked:border-accent-600 focus:ring-2 focus:ring-accent-400 focus:ring-offset-0 cursor-pointer transition-colors">
          <span class="text-[13px] leading-relaxed text-secondary-700">
            I have read and understood this Data Privacy Notice and agree to Toyota Ilocos Sur's
            <a href="/privacy-policy" target="_blank" class="text-accent-600 font-medium hover:underline underline-offset-2">Terms of Service</a>.
          </span>
        </label>

        <label
          class="flex items-start gap-3 p-3 rounded-xl border cursor-pointer transition-all duration-150 select-none"
          :class="consentPrivacy ? 'border-accent-300 bg-accent-50 ring-1 ring-accent-200' : 'border-primary-200 bg-white hover:border-primary-300'">
          <input
            type="checkbox"
            x-model="consentPrivacy"
            class="mt-0.5 shrink-0 size-4 rounded border-primary-300 checked:bg-accent-600 checked:border-accent-600 focus:ring-2 focus:ring-accent-400 focus:ring-offset-0 cursor-pointer transition-colors">
          <span class="text-[13px] leading-relaxed text-secondary-700">
            I consent to Toyota Ilocos Sur collecting and using my vehicle details and contact information
            for the purposes described above.
          </span>
        </label>
      </div>

      <div class="px-6 pt-3 pb-5 border-t border-primary-200 space-y-3">
        <div
          x-show="!hasScrolledToBottom"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0">
          <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-[11px] font-medium bg-primary-100 text-primary-500 animate-pulse">
            <svg class="size-3" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
              <path d="M8 3V13M8 13L4 9M8 13L12 9" />
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
              class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-primary-200 bg-white text-primary-700 shadow-sm hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-300 disabled:opacity-50 disabled:pointer-events-none transition-colors">
              Decline
            </button>
            <button
              type="button"
              @click="onAccept()"
              :disabled="!canAccept || isSubmitting"
              class="py-2 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-accent-400 focus:ring-offset-1 transition-all duration-200 disabled:opacity-40 disabled:pointer-events-none"
              :class="canAccept ? 'bg-accent-600 text-white hover:bg-accent-700 hover:-translate-y-px shadow-sm hover:shadow-lg' : 'bg-primary-300 text-white'">
              <template x-if="!isSubmitting">
                <span class="flex items-center gap-2">
                  <svg class="size-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 1.5A6.5 6.5 0 1 0 14.5 8" />
                    <path d="M5 8L7 10L11 6" />
                  </svg>
                  I Agree & Continue
                </span>
              </template>
              <template x-if="isSubmitting">
                <span class="flex items-center gap-2">
                  <svg class="animate-spin size-4 shrink-0" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-opacity=".25" stroke-width="2" />
                    <path d="M8 2a6 6 0 0 1 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[60] inline-flex items-center gap-2.5 py-3 px-5 rounded-full bg-primary-900 text-white text-sm font-medium shadow-xl whitespace-nowrap ring-1 ring-white/10">
    <svg class="size-4 text-green-400 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
      <circle cx="8" cy="8" r="7" />
      <path d="M5 8L7 10L11 5.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    Thank you. Your consent has been recorded.
  </div>

</div>