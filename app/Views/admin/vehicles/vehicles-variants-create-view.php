<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<nav class="mb-5" aria-label="Breadcrumb">
  <ol class="flex items-center gap-1.5 text-sm text-gray-500">
    <li><a href="/admin/vehicles" class="hover:text-gray-800 transition-colors">Vehicles</a></li>
    <li><svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="m9 18 6-6-6-6" />
      </svg></li>
    <li><a href="/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>" class="hover:text-gray-800 transition-colors"><?= esc($cc->vehicle_title) ?></a></li>
    <li><svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="m9 18 6-6-6-6" />
      </svg></li>
    <li class="font-medium text-gray-800">Add Variant</li>
  </ol>
</nav>

<div x-data="VariantsCreate('<?= csrf_hash() ?>')" class="flex flex-row-reverse flex-wrap justify-end gap-3 w-full">

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
  <form @submit.prevent="add($event)" id="vehicle-variant-add-form" method="post" class="w-full max-w-3xl">
    <input x-model="csrf_token" type="hidden" name="csrf_token">
    <input type="hidden" name="vehicle" value="<?= esc($cc->vehicle_no) ?>">

    <!-- Vehicle Banner -->
    <div class="flex items-center gap-4 bg-white border border-gray-200 rounded-xl p-4 mb-5">
      <div class="size-12 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
        <svg class="size-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M5 17H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h1m15 10h2a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-1M8 17h8M7 9l1-4h8l1 4" />
          <circle cx="7.5" cy="17.5" r="1.5" />
          <circle cx="16.5" cy="17.5" r="1.5" />
        </svg>
      </div>
      <div class="flex-1 min-w-0">
        <p class="text-sm font-medium text-gray-900 leading-tight"><?= esc($cc->vehicle_title) ?></p>
        <p class="text-xs text-gray-500 mt-0.5 truncate"><?= esc($cc->vehicle_tagline) ?></p>
      </div>
    </div>

    <!-- Variant Details -->
    <fieldset class="flex flex-col gap-5 bg-white border border-gray-100 rounded-xl px-6 py-6">
      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Variant Details</legend>

      <!-- Variant Model -->
      <div>
        <label for="model" class="block text-sm font-medium mb-2">Variant Model</label>
        <input
          type="text"
          id="model"
          name="model"
          placeholder="e.g. 1.5L Executive CVT"
          class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
      </div>

      <!-- Price Row -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="price" class="block text-sm font-medium mb-2">Price (Full)</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 text-sm pointer-events-none">PHP</span>
            <input
              type="number" id="price" name="price" min="0" step="0.01" placeholder="0.00"
              class="py-2.5 sm:py-3 pl-12 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
        <div>
          <label for="price_month" class="block text-sm font-medium mb-2">Price (Monthly)</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 text-sm pointer-events-none">PHP</span>
            <input
              type="number" id="price_month" name="price_month" min="0" step="0.01" placeholder="0.00"
              class="py-2.5 sm:py-3 pl-12 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
      </div>

      <!-- Toggles -->
      <div class="flex flex-col sm:flex-row gap-3">
        <label for="isshowprice" class="flex items-center justify-between gap-4 w-full sm:flex-1 cursor-pointer rounded-lg border border-gray-200 bg-white px-4 py-3 hover:bg-gray-50 transition-colors">
          <div>
            <span class="block text-sm font-medium text-gray-800">Show Price</span>
            <span class="block text-xs text-gray-500 mt-0.5">Display price publicly on listing</span>
          </div>
          <div class="relative">
            <input type="checkbox" id="isshowprice" name="isshowprice" value="1" class="sr-only peer">
            <div class="w-10 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary-600 transition-colors duration-200 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4"></div>
          </div>
        </label>
        <label for="isdefault" class="flex items-center justify-between gap-4 w-full sm:flex-1 cursor-pointer rounded-lg border border-gray-200 bg-white px-4 py-3 hover:bg-gray-50 transition-colors">
          <div>
            <span class="block text-sm font-medium text-gray-800">Set as Default</span>
            <span class="block text-xs text-gray-500 mt-0.5">Use as the default variant selection</span>
          </div>
          <div class="relative">
            <input @click="onDefaultToggle($event)" type="checkbox" id="isdefault" name="isdefault" value="1" class="sr-only peer">
            <div class="w-10 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary-600 transition-colors duration-200 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4"></div>
          </div>
        </label>
      </div>

    </fieldset>

    <!-- Submit -->
    <div class="flex justify-end pt-4">
      <button
        :disabled="loading"
        type="submit"
        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none">
        <span x-show="loading" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent rounded-[999px] text-primary-foreground" role="status" aria-label="loading"></span>
        <span x-text="loading ? 'Loading...' : 'Add Variant'"></span>
      </button>
    </div>

  </form>
</div>
<?= $this->endSection() ?>