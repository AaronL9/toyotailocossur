<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div class="flex flex-row-reverse flex-wrap justify-end gap-3 w-full">

  <!-- Validation Errors -->
  <?php if (session()->has('errors')): ?>
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
              <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- Success Message -->
  <?php if (session()->has('success')): ?>
    <div class="bg-green-50 border border-green-200 text-sm text-green-800 rounded-lg p-4 max-h-fit w-full max-w-3xl" role="alert">
      <div class="flex items-center gap-3">
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
          <path d="m9 11 3 3L22 4" />
        </svg>
        <p><?= esc(session('success')) ?></p>
      </div>
    </div>
  <?php endif; ?>

  <!-- Form -->
  <form action="<?= site_url('admin/agents/upload-photo/' . esc($cc->agent_no)) ?>" method="post" enctype="multipart/form-data" class="w-full max-w-3xl">
    <?= csrf_field() ?>

    <fieldset class="flex flex-col gap-6 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6">
      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Agent Photo</legend>

      <!-- Current Photo & Upload -->
      <div class="flex flex-col sm:flex-row items-start gap-6">

        <!-- Current Photo -->
        <div class="flex flex-col gap-2 shrink-0">
          <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Current Photo</p>
          <div class="w-24 h-28 rounded-lg overflow-hidden border border-gray-200 bg-gray-100 flex items-center justify-center">
            <?php if (!empty($cc->agent_photo)): ?>
              <img
                src="<?= site_url('img/agents/' . esc($cc->agent_photo)) ?>"
                alt="<?= esc($cc->agent_fname . ' ' . $cc->agent_lname) ?>"
                class="w-full h-full object-cover object-top">
            <?php else: ?>
              <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4" />
                <path d="M20 21a8 8 0 1 0-16 0" />
              </svg>
            <?php endif; ?>
          </div>
          <?php if (empty($cc->agent_photo)): ?>
            <span class="text-xs text-gray-300 italic">No photo set</span>
          <?php endif; ?>
        </div>

        <!-- Divider -->
        <div class="hidden sm:flex items-center self-stretch">
          <div class="w-px h-full bg-gray-100"></div>
        </div>

        <!-- Upload Area -->
        <div class="flex flex-col gap-3 flex-1 w-full">
          <div>
            <p class="text-sm font-medium text-gray-800">Upload New Photo</p>
            <p class="text-xs text-gray-400 mt-0.5">Accepted formats: JPG, PNG, WEBP. Maximum file size: 2MB.</p>
          </div>

          <label for="userfile" class="sr-only">Choose file</label>
          <input
            type="file"
            id="userfile"
            name="userfile"
            accept=".jpg,.jpeg,.png,.webp"
            class="block w-full bg-layer border border-layer-line rounded-lg text-sm text-foreground placeholder:text-muted-foreground-1 focus:z-10 focus:outline-hidden focus:border-primary-focus focus:ring-1 focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none
              file:bg-surface file:border-0
              file:me-4
              file:py-3 file:px-4">


          <?php if (session()->getFlashdata("userfile_error")): ?>
            <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
              <div class="flex">
                <div class="shrink-0">
                  <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m15 9-6 6"></path>
                    <path d="m9 9 6 6"></path>
                  </svg>
                </div>
                <div class="ms-3">
                  <p class="font-medium"><?= session()->getFlashdata("userfile_error") ?></p>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <!-- File name display (no JS fallback) -->
          <?php if (!empty(old('agent_photo'))): ?>
            <p class="text-xs text-gray-500">Selected: <?= esc(old('agent_photo')) ?></p>
          <?php endif; ?>

        </div>
      </div>

      <!-- Agent Info (read-only reference) -->
      <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-lg border border-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="4" />
          <path d="M20 21a8 8 0 1 0-16 0" />
        </svg>
        <div class="text-sm">
          <span class="font-medium text-gray-800">
            <?= esc($cc->agent_fname . ' ' . (!empty($cc->agent_mname) ? $cc->agent_mname . ' ' : '') . $cc->agent_lname) ?>
          </span>
          <?php if (!empty($cc->agent_email)): ?>
            <span class="text-gray-400 ml-2">&mdash; <?= esc($cc->agent_email) ?></span>
          <?php endif; ?>
        </div>
      </div>

    </fieldset>

    <!-- Actions -->
    <div class="flex items-center justify-between pt-4">
      <a
        href="<?= site_url('admin/agents') ?>"
        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 focus:outline-hidden transition-colors">
        Cancel
      </a>
      <button
        type="submit"
        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
          <polyline points="17 8 12 3 7 8" />
          <line x1="12" x2="12" y1="3" y2="15" />
        </svg>
        Upload Photo
      </button>
    </div>

  </form>
</div>

<?= $this->endSection() ?>