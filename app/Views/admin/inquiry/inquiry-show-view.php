<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div class="w-full mx-auto">

  <!-- Back + Status -->
  <div class="mb-5 flex items-center justify-between">
    <a href="/admin/inquiry" class="inline-flex items-center gap-x-1.5 text-sm text-gray-500 hover:text-gray-800 focus:outline-hidden">
      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6" />
      </svg>
      Back to Inquiries
    </a>

    <?php if ($cc->inquiry_inactive == 1): ?>
      <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-700">
        <span class="size-1.5 inline-block rounded-full bg-red-600"></span>
        Inactive
      </span>
    <?php else: ?>
      <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-700">
        <span class="size-1.5 inline-block rounded-full bg-teal-600"></span>
        Active
      </span>
    <?php endif; ?>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    <!-- Left: Main Info -->
    <div class="lg:col-span-2 flex flex-col gap-5">

      <!-- Contact Info Card -->
      <div class="border border-gray-200 rounded-lg px-5 py-5">
        <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Contact Information</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Full Name</span>
            <span class="text-sm font-medium text-gray-800"><?= esc($cc->inquiry_name ?? '—') ?></span>
          </div>

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Email Address</span>
            <?php if (!empty($cc->inquiry_email)): ?>
              <a href="mailto:<?= esc($cc->inquiry_email) ?>" class="text-sm font-medium text-accent-600 hover:text-accent-400"><?= esc($cc->inquiry_email) ?></a>
            <?php else: ?>
              <span class="text-sm font-medium text-gray-800">—</span>
            <?php endif; ?>
          </div>

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Contact Number</span>
            <?php if (!empty($cc->inquiry_contact)): ?>
              <a href="tel:<?= esc($cc->inquiry_contact) ?>" class="text-sm font-medium text-gray-800"><?= esc($cc->inquiry_contact) ?></a>
            <?php else: ?>
              <span class="text-sm font-medium text-gray-800">—</span>
            <?php endif; ?>
          </div>

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Date Submitted</span>
            <span class="text-sm font-medium text-gray-800">
              <?= !empty($cc->inquiry_date) ? date('F j, Y', strtotime($cc->inquiry_date)) : '—' ?>
            </span>
          </div>

        </div>
      </div>

      <!-- Vehicle Info Card -->
      <div class="border border-gray-200 rounded-lg px-5 py-5">
        <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Vehicle Information</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-8 gap-y-4">

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Plate No.</span>
            <span class="text-sm font-medium text-gray-800"><?= esc($cc->inquiry_plateno ?? '—') ?></span>
          </div>

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Year</span>
            <span class="text-sm font-medium text-gray-800"><?= esc($cc->inquiry_year ?? '—') ?></span>
          </div>

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Mileage</span>
            <span class="text-sm font-medium text-gray-800">
              <?= !empty($cc->inquiry_milage) ? esc($cc->inquiry_milage) . ' km' : '—' ?>
            </span>
          </div>

        </div>
      </div>

      <!-- Message Card -->
      <div class="border border-gray-200 rounded-lg px-5 py-5">
        <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Inquiry Message</h2>
        <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line"><?= esc($cc->inquiry_content ?? '—') ?></p>
      </div>

    </div>

    <!-- Right Sidebar -->
    <div class="flex flex-col gap-5">

      <!-- Appointment Card -->
      <div class="border border-gray-200 rounded-lg px-5 py-5">
        <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Appointment</h2>

        <div class="flex flex-col gap-y-4">

          <div class="flex items-start gap-x-3">
            <div class="mt-0.5 flex-shrink-0 size-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-500">
              <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                <line x1="16" x2="16" y1="2" y2="6" />
                <line x1="8" x2="8" y1="2" y2="6" />
                <line x1="3" x2="21" y1="10" y2="10" />
              </svg>
            </div>
            <div class="flex flex-col gap-y-0.5">
              <span class="text-xs text-gray-400">Date</span>
              <span class="text-sm font-medium text-gray-800">
                <?= !empty($cc->inquiry_appointment_date) ? date('F j, Y', strtotime($cc->inquiry_appointment_date)) : '—' ?>
              </span>
            </div>
          </div>

          <div class="flex items-start gap-x-3">
            <div class="mt-0.5 flex-shrink-0 size-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-500">
              <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
            </div>
            <div class="flex flex-col gap-y-0.5">
              <span class="text-xs text-gray-400">Time</span>
              <span class="text-sm font-medium text-gray-800">
                <?= !empty($cc->inquiry_appointment_time) ? date('g:i A', strtotime($cc->inquiry_appointment_time)) : '—' ?>
              </span>
            </div>
          </div>

        </div>
      </div>

      <!-- Reference Card -->
      <div class="border border-gray-200 rounded-lg px-5 py-5">
        <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Reference</h2>
        <div class="flex flex-col gap-y-4">

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Inquiry No.</span>
            <span class="text-sm font-medium text-gray-800 font-mono">#<?= esc($cc->inquiry_no ?? '—') ?></span>
          </div>

          <div class="flex flex-col gap-y-0.5">
            <span class="text-xs text-gray-400">Vehicle Name</span>
            <span class="text-sm font-medium text-gray-800 font-mono"><?= esc($vehicle->vehicle_title ?? '—') ?></span>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
<?= $this->endSection() ?>