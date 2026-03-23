<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>

<div x-data="UserModulesPage('<?= csrf_hash() ?>')" class="w-full max-w-3xl px-2 flex flex-col gap-6">

  <!-- Page Header -->
  <div>
    <h1 class="text-2xl font-bold text-gray-800">Module Access</h1>
    <p class="text-sm text-gray-500 mt-1">Manage which modules this user can access in the system.</p>
  </div>

  <!-- Breadcrumb -->
  <nav class="flex items-center gap-1.5 text-xs text-gray-400">
    <a href="<?= site_url('admin/users') ?>" class="hover:text-gray-600 transition-colors">Users</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="<?= site_url('admin/users/edit/' . $user->user_no) ?>" class="hover:text-gray-600 transition-colors">
      <?= esc($user->user_fname . ' ' . $user->user_lname) ?>
    </a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600 font-medium">Module Access</span>
  </nav>

  <!-- User Info Banner -->
  <div class="flex items-center gap-4 px-5 py-4 bg-white border border-gray-200 rounded-xl shadow-sm">
    <div class="size-10 rounded-full bg-primary-100 flex items-center justify-center shrink-0">
      <i class="fa-solid fa-user text-primary-600 text-sm"></i>
    </div>
    <div>
      <p class="text-sm font-semibold text-gray-800">
        <?= esc($user->user_lname . ', ' . $user->user_fname . (!empty($user->user_mname) ? ' ' . $user->user_mname : '')) ?>
      </p>
      <p class="text-xs text-gray-400">@<?= esc($user->user_uname) ?> &bull; #<?= esc($user->user_no) ?></p>
    </div>
  </div>

  <!-- Module Access Card -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

    <!-- Card Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
      <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider">Available Modules</h2>
      <div class="flex items-center gap-2">
        <span x-text="`${grantedCount} of ${modules.length} granted`" class="text-xs text-gray-400"></span>
        <button
          type="button"
          @click="toggleAll()"
          class="text-xs font-medium text-primary-700 hover:text-primary-900 transition-colors">
          <span x-text="allGranted ? 'Revoke All' : 'Grant All'"></span>
        </button>
      </div>
    </div>

    <!-- Loading State -->
    <template x-if="loading">
      <div class="flex justify-center items-center py-16">
        <div class="animate-spin inline-block size-7 border-3 border-current border-t-transparent rounded-full text-primary-600" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </template>

    <!-- Empty State -->
    <template x-if="!loading && modules.length === 0">
      <div class="flex flex-col items-center gap-2 py-16 text-gray-400">
        <i class="fa-solid fa-layer-group text-3xl"></i>
        <p class="text-sm">No modules found.</p>
      </div>
    </template>

    <!-- Module List -->
    <template x-if="!loading && modules.length > 0">
      <ul class="divide-y divide-gray-100">
        <template x-for="mod in modules" :key="mod.mod_no">
          <li
            class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-gray-50 transition-colors duration-100"
            :class="{ 'opacity-50': mod.saving }">

            <!-- Icon + Info -->
            <div class="flex items-center gap-3 min-w-0">
              <div class="size-9 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                <i :class="mod.mod_icon || 'fa-solid fa-puzzle-piece'" class="text-gray-500 text-sm"></i>
              </div>
              <div class="min-w-0">
                <p class="text-sm font-medium text-gray-800 truncate" x-text="mod.mod_title"></p>
                <p class="text-xs text-gray-400 truncate" x-text="mod.mod_link"></p>
              </div>
            </div>

            <!-- Toggle -->
            <div class="flex items-center gap-3 shrink-0">

              <!-- Status Badge -->
              <span
                x-show="mod.granted"
                class="hidden sm:inline-flex items-center gap-1 text-xs font-medium text-green-700 bg-green-50 border border-green-100 rounded-full px-2 py-0.5">
                <i class="fa-solid fa-circle-check text-[10px]"></i> Granted
              </span>
              <span
                x-show="!mod.granted"
                class="hidden sm:inline-flex items-center gap-1 text-xs font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-full px-2 py-0.5">
                <i class="fa-solid fa-circle-xmark text-[10px]"></i> No Access
              </span>

              <!-- Saving Spinner -->
              <template x-if="mod.saving">
                <div class="animate-spin size-4 border-2 border-current border-t-transparent rounded-full text-primary-600" role="status">
                  <span class="sr-only">Saving...</span>
                </div>
              </template>

              <!-- Toggle Switch -->
              <label class="relative inline-block w-11 h-6 cursor-pointer">
                <input
                  type="checkbox"
                  class="peer sr-only"
                  :checked="mod.granted"
                  :disabled="mod.saving"
                  @change="toggleModule(mod, $event)">
                <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary-600 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                <span class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full"></span>
              </label>

            </div>
          </li>
        </template>
      </ul>
    </template>

  </div>

  <!-- Encoded By Info Banner -->
  <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-lg border border-gray-100">
    <i class="fa-solid fa-circle-info text-gray-400 text-sm"></i>
    <p class="text-xs text-gray-500">
      Changes are saved immediately. Encoded by
      <span class="font-medium text-gray-700"><?= esc(session()->get('user_uname') ?? 'current user') ?></span>
      on <span class="font-medium text-gray-700"><?= date('F j, Y') ?></span>.
    </p>
  </div>

  <!-- Success / Error Toast -->
  <div
    x-show="toast.show"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    :class="toast.type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'"
    class="fixed bottom-6 right-6 flex items-center gap-3 px-4 py-3 rounded-lg border shadow-md text-sm font-medium z-50"
    style="display: none;">
    <i :class="toast.type === 'success' ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-xmark'" class="text-base"></i>
    <span x-text="toast.message"></span>
  </div>

  <!-- Back Action -->
  <div class="pb-4">
    <a
      href="<?= site_url('admin/users') ?>"
      class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 transition-colors duration-150">
      <i class="fa-solid fa-arrow-left text-xs"></i>
      Back to Users
    </a>
  </div>

</div>

<script>
  window.APP = {
    flash: <?= json_encode(session()->getFlashdata()) ?>,
    userNo: <?= json_encode($user->user_no) ?>
  }
</script>

<?= $this->endSection() ?>