<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>

<div x-data="UsersCreatePage()" class="w-full max-w-3xl px-2 flex flex-col gap-6">

  <!-- Page Header -->
  <div>
    <h1 class="text-2xl font-bold text-gray-800">Create User</h1>
    <p class="text-sm text-gray-500 mt-1">Add a new administrator or staff account to the system.</p>
  </div>

  <!-- Breadcrumb -->
  <nav class="flex items-center gap-1.5 text-xs text-gray-400">
    <a href="<?= site_url('admin/users') ?>" class="hover:text-gray-600 transition-colors">Users</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600 font-medium">Create</span>
  </nav>

  <!-- ── Form Card ─────────────────────────────────────────────────── -->
  <form
    @submit.prevent="onSubmit($event)"
    action="<?= site_url('admin/users/store') ?>"
    method="post"
    class="flex flex-col gap-6">

    <?= csrf_field() ?>

    <!-- Personal Information -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

      <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-5">Personal Information</h2>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <!-- Last Name -->
        <div class="flex flex-col gap-1.5">
          <label for="user_lname" class="text-xs font-medium text-gray-600">
            Last Name <span class="text-red-500">*</span>
          </label>
          <input
            type="text"
            id="user_lname"
            name="user_lname"
            value="<?= old('user_lname') ?>"
            placeholder="e.g. Dela Cruz"
            class="py-2 px-3 block w-full border <?= session()->getFlashdata('errors.user_lname') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 bg-gray-50 focus:border-primary-500 focus:ring-primary-100' ?> rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors duration-150" />
          <?php if (session()->getFlashdata('errors.user_lname')): ?>
            <p class="text-xs text-red-500 flex items-center gap-1">
              <i class="fa-solid fa-circle-exclamation text-[10px]"></i>
              <?= session()->getFlashdata('errors.user_lname') ?>
            </p>
          <?php endif; ?>
        </div>

        <!-- First Name -->
        <div class="flex flex-col gap-1.5">
          <label for="user_fname" class="text-xs font-medium text-gray-600">
            First Name <span class="text-red-500">*</span>
          </label>
          <input
            type="text"
            id="user_fname"
            name="user_fname"
            value="<?= old('user_fname') ?>"
            placeholder="e.g. Juan"
            class="py-2 px-3 block w-full border <?= session()->getFlashdata('errors.user_fname') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 bg-gray-50 focus:border-primary-500 focus:ring-primary-100' ?> rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors duration-150" />
          <?php if (session()->getFlashdata('errors.user_fname')): ?>
            <p class="text-xs text-red-500 flex items-center gap-1">
              <i class="fa-solid fa-circle-exclamation text-[10px]"></i>
              <?= session()->getFlashdata('errors.user_fname') ?>
            </p>
          <?php endif; ?>
        </div>

        <!-- Middle Name -->
        <div class="flex flex-col gap-1.5">
          <label for="user_mname" class="text-xs font-medium text-gray-600">
            Middle Name
            <span class="text-gray-400 font-normal">(optional)</span>
          </label>
          <input
            type="text"
            id="user_mname"
            name="user_mname"
            value="<?= old('user_mname') ?>"
            placeholder="e.g. Santos"
            class="py-2 px-3 block w-full border border-gray-200 bg-gray-50 rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:border-primary-500 focus:ring-primary-100 transition-colors duration-150" />
        </div>

      </div>
    </div>

    <!-- Account Credentials -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

      <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-5">Account Credentials</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        <!-- Username -->
        <div class="flex flex-col gap-1.5">
          <label for="user_uname" class="text-xs font-medium text-gray-600">
            Username <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-regular fa-user text-gray-400 text-xs"></i>
            </div>
            <input
              type="text"
              id="user_uname"
              name="user_uname"
              value="<?= old('user_uname') ?>"
              placeholder="e.g. jdelacruz"
              autocomplete="off"
              class="py-2 pl-8 pr-3 block w-full border <?= session()->getFlashdata('errors.user_uname') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 bg-gray-50 focus:border-primary-500 focus:ring-primary-100' ?> rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors duration-150" />
          </div>
          <?php if (session()->getFlashdata('errors.user_uname')): ?>
            <p class="text-xs text-red-500 flex items-center gap-1">
              <i class="fa-solid fa-circle-exclamation text-[10px]"></i>
              <?= session()->getFlashdata('errors.user_uname') ?>
            </p>
          <?php else: ?>
            <p class="text-xs text-gray-400">Must be unique. Letters and numbers only.</p>
          <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-1.5">
          <label for="user_pword" class="text-xs font-medium text-gray-600">
            Password <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-lock text-gray-400 text-xs"></i>
            </div>
            <input
              :type="showPassword ? 'text' : 'password'"
              id="user_pword"
              name="user_pword"
              placeholder="Min. 8 characters"
              autocomplete="new-password"
              class="py-2 pl-8 pr-10 block w-full border <?= session()->getFlashdata('errors.user_pword') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 bg-gray-50 focus:border-primary-500 focus:ring-primary-100' ?> rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors duration-150" />
            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors">
              <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-xs"></i>
            </button>
          </div>
          <?php if (session()->getFlashdata('errors.user_pword')): ?>
            <p class="text-xs text-red-500 flex items-center gap-1">
              <i class="fa-solid fa-circle-exclamation text-[10px]"></i>
              <?= session()->getFlashdata('errors.user_pword') ?>
            </p>
          <?php else: ?>
            <p class="text-xs text-gray-400">At least 8 characters recommended.</p>
          <?php endif; ?>
        </div>

        <!-- Confirm Password -->
        <div class="flex flex-col gap-1.5 sm:col-span-2">
          <label for="user_pword_confirm" class="text-xs font-medium text-gray-600">
            Confirm Password <span class="text-red-500">*</span>
          </label>
          <div class="relative sm:max-w-sm">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <i class="fa-solid fa-lock-open text-gray-400 text-xs"></i>
            </div>
            <input
              :type="showConfirm ? 'text' : 'password'"
              id="user_pword_confirm"
              name="user_pword_confirm"
              placeholder="Re-enter password"
              autocomplete="new-password"
              class="py-2 pl-8 pr-10 block w-full border <?= session()->getFlashdata('errors.user_pword_confirm') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 bg-gray-50 focus:border-primary-500 focus:ring-primary-100' ?> rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors duration-150" />
            <button
              type="button"
              @click="showConfirm = !showConfirm"
              class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors">
              <i :class="showConfirm ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-xs"></i>
            </button>
          </div>
          <?php if (session()->getFlashdata('errors.user_pword_confirm')): ?>
            <p class="text-xs text-red-500 flex items-center gap-1">
              <i class="fa-solid fa-circle-exclamation text-[10px]"></i>
              <?= session()->getFlashdata('errors.user_pword_confirm') ?>
            </p>
          <?php endif; ?>
        </div>

      </div>
    </div>

    <!-- Account Status -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

      <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-5">Account Status</h2>

      <label class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-100">
        <div class="mt-0.5">
          <input
            type="checkbox"
            name="user_inactive"
            id="user_inactive"
            value="1"
            <?= old('user_inactive') ? 'checked' : '' ?>
            class="shrink-0 size-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 cursor-pointer" />
        </div>
        <div>
          <p class="text-sm font-medium text-gray-700">Set as Inactive</p>
          <p class="text-xs text-gray-400 mt-0.5">Inactive users cannot log in to the system. You can activate them later.</p>
        </div>
      </label>

    </div>

    <!-- Encoded By Info Banner -->
    <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-lg border border-gray-100">
      <i class="fa-solid fa-circle-info text-gray-400 text-sm"></i>
      <p class="text-xs text-gray-500">
        This record will be encoded by
        <span class="font-medium text-gray-700"><?= esc(session()->get('user_uname') ?? 'current user') ?></span>
        on <span class="font-medium text-gray-700"><?= date('F j, Y') ?></span>.
      </p>
    </div>

    <!-- Error Summary -->
    <?php if (session()->getFlashdata('error')): ?>
      <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
        <div class="flex gap-x-3">
          <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="m15 9-6 6" />
            <path d="m9 9 6 6" />
          </svg>
          <p class="font-medium"><?= session()->getFlashdata('error') ?></p>
        </div>
      </div>
    <?php endif; ?>

    <!-- ── Actions ──────────────────────────────────────────────────── -->
    <div class="flex items-center justify-between pt-1 pb-4">

      <a
        href="<?= site_url('admin/users') ?>"
        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors duration-150">
        <i class="fa-solid fa-arrow-left text-xs"></i>
        Back to Users
      </a>

      <button
        type="submit"
        :disabled="submitting"
        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 text-white hover:bg-primary-800 disabled:opacity-60 disabled:cursor-not-allowed transition-colors duration-150">
        <i :class="submitting ? 'fa-solid fa-circle-notch fa-spin' : 'fa-solid fa-user-plus'" class="text-xs"></i>
        <span x-text="submitting ? 'Creating…' : 'Create User'"></span>
      </button>

    </div>

  </form>

</div>

<?= $this->endSection() ?>