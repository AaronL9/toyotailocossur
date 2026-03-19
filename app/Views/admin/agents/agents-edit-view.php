<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div x-data="AgentCreate('<?= csrf_hash() ?>')" class="flex flex-row-reverse flex-wrap justify-end gap-3 w-full">

  <!-- Validation Errors -->
  <template x-if="validation">
    <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4 max-h-fit w-full max-w-3xl" role="alert">
      <div class="flex">
        <div class="shrink-0">
          <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="m15 9-6 6" />
            <path d="m9 9 6 6" />
          </svg>
        </div>
        <div class="ms-4">
          <h3 class="text-sm font-semibold">A problem has been occurred while submitting your data.</h3>
          <div class="mt-2 text-sm text-red-800">
            <ul class="list-disc space-y-1 ps-5">
              <template x-for="(value, index) in validation">
                <li x-text="value"></li>
              </template>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </template>

  <!-- Form -->
  <form @submit.prevent="update($event)" id="agent-add-form" method="post" action="/api/agents/<?= $cc->agent_no ?>" class="w-full max-w-3xl">
    <input x-model="csrf_token" type="hidden" name="csrf_token">

    <!-- Personal Information -->
    <fieldset class="flex flex-col gap-5 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6">
      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Personal Information</legend>

      <!-- Name Row -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
          <label for="fname" class="block text-sm font-medium mb-2">First Name</label>
          <input
            type="text"
            id="fname"
            name="fname"
            placeholder="e.g. Juan"
            value="<?= $cc->agent_fname ?>"
            class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <div>
          <label for="mname" class="block text-sm font-medium mb-2">Middle Name</label>
          <input
            type="text"
            id="mname"
            name="mname"
            placeholder="e.g. Santos"
            value="<?= $cc->agent_mname ?>"
            class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
        <div>
          <label for="lname" class="block text-sm font-medium mb-2">Last Name</label>
          <input
            type="text"
            id="lname"
            name="lname"
            placeholder="e.g. Dela Cruz"
            value="<?= $cc->agent_lname ?>"
            class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
      </div>

      <!-- Contact & Email -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="contact" class="block text-sm font-medium mb-2">Contact Number</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.9 15.58 19.79 19.79 0 0 1 1.88 7 2 2 0 0 1 3.86 5h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 12.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 19.92z" />
              </svg>
            </span>
            <input
              type="text"
              id="contact"
              name="contact"
              placeholder="e.g. 09123456789"
              value="<?= $cc->agent_contact ?>"
              class="py-2.5 sm:py-3 pl-11 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="20" height="16" x="2" y="4" rx="2" />
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
              </svg>
            </span>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="e.g. agent@example.com"
              value="<?= $cc->agent_email ?>"
              class="py-2.5 sm:py-3 pl-11 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
      </div>

      <!-- Status Toggle -->
      <label for="inactive" class="flex items-center justify-between gap-4 w-full cursor-pointer rounded-lg border border-gray-200 bg-white px-4 py-3 hover:bg-gray-50 transition-colors">
        <div>
          <span class="block text-sm font-medium text-gray-800">Set as Inactive</span>
          <span class="block text-xs text-gray-500 mt-0.5">Agent will not appear on public listings</span>
        </div>
        <div class="relative">
          <input type="checkbox" id="inactive" name="inactive" value="1" class="sr-only peer">
          <div class="w-10 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary-600 transition-colors duration-200 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4"></div>
        </div>
      </label>

    </fieldset>

    <!-- Social Media -->
    <fieldset class="flex flex-col gap-5 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6 mt-4">
      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Social Media</legend>

      <!-- Facebook -->
      <div>
        <label for="fb" class="block text-sm font-medium mb-2">Facebook</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 text-xs pointer-events-none font-medium">
            facebook.com/
          </span>
          <input
            type="text"
            id="fb"
            name="fb"
            placeholder="username"
            value="<?= $cc->agent_fb ?>"
            class="py-2.5 sm:py-3 pl-28 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
      </div>

      <!-- Instagram -->
      <div>
        <label for="ig" class="block text-sm font-medium mb-2">Instagram</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 text-xs pointer-events-none font-medium">
            instagram.com/
          </span>
          <input
            type="text"
            id="ig"
            name="ig"
            placeholder="username"
            value="<?= $cc->agent_ig ?>"
            class="py-2.5 sm:py-3 pl-28 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
      </div>

      <!-- Twitter / X -->
      <div>
        <label for="tw" class="block text-sm font-medium mb-2">X (Twitter)</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 text-xs pointer-events-none font-medium">
            x.com/
          </span>
          <input
            type="text"
            id="tw"
            name="tw"
            placeholder="username"
            value="<?= $cc->agent_tw ?>"
            class="py-2.5 sm:py-3 pl-14 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
        </div>
      </div>

    </fieldset>

    <!-- Submit -->
    <div class="flex justify-end pt-4">
      <button
        :disabled="loading"
        type="submit"
        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none">
        <span x-show="loading" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent rounded-[999px] text-primary-foreground" role="status" aria-label="loading"></span>
        <span x-text="loading ? 'Loading...' : 'Update Agent'"></span>
      </button>
    </div>

  </form>
</div>

<?= $this->endSection() ?>