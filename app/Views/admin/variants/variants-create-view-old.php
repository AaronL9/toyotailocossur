<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
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

    <fieldset class="flex flex-col gap-5 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6">

      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Vehicle Variant Details</legend>

      <!-- Vehicle No (Select) -->
      <div>
        <label for="vehicle" class="block text-sm font-medium mb-2">Vehicle</label>
        <select id="vehicle" name="vehicle" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm bg-white focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          <option value="" disabled selected>Select a vehicle...</option>
          <?php foreach ($vehicles as $row): ?>
            <option value="<?= esc($row->vehicle_no) ?>"><?= esc($row->vehicle_title) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

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
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 text-sm pointer-events-none">RM</span>
            <input
              type="number"
              id="price"
              name="price"
              min="0"
              step="0.01"
              placeholder="0.00"
              class="py-2.5 sm:py-3 pl-12 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>

        <div>
          <label for="price_month" class="block text-sm font-medium mb-2">Price (Monthly)</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 text-sm pointer-events-none">RM</span>
            <input
              type="number"
              id="price_month"
              name="price_month"
              min="0"
              step="0.01"
              placeholder="0.00"
              class="py-2.5 sm:py-3 pl-12 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
      </div>

      <!-- Toggle Options -->
      <div class="flex flex-col sm:flex-row gap-4">

        <!-- Show Price Toggle -->
        <label for="isshowprice" class="flex items-center justify-between gap-4 w-full sm:w-auto sm:flex-1 cursor-pointer rounded-lg border border-gray-200 bg-white px-4 py-3 hover:bg-gray-50 transition-colors">
          <div>
            <span class="block text-sm font-medium text-gray-800">Show Price</span>
            <span class="block text-xs text-gray-500 mt-0.5">Display price publicly on listing</span>
          </div>
          <div class="relative">
            <input type="checkbox" id="isshowprice" name="isshowprice" value="1" class="sr-only peer">
            <div class="w-10 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary-600 transition-colors duration-200 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4"></div>
          </div>
        </label>

        <!-- Is Default Toggle -->
        <label for="isdefault" class="flex items-center justify-between gap-4 w-full sm:w-auto sm:flex-1 cursor-pointer rounded-lg border border-gray-200 bg-white px-4 py-3 hover:bg-gray-50 transition-colors">
          <div>
            <span class="block text-sm font-medium text-gray-800">Set as Default</span>
            <span class="block text-xs text-gray-500 mt-0.5">Use as the default variant selection</span>
          </div>
          <div class="relative">
            <input type="checkbox" id="isdefault" name="isdefault" value="1" class="sr-only peer">
            <div class="w-10 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary-600 transition-colors duration-200 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4"></div>
          </div>
        </label>

      </div>

      <!-- Submit -->
      <div class="flex justify-end pt-1">
        <button
          :disabled="loading"
          type="submit"
          class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none">
          <span x-show="loading" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent rounded-[999px] text-primary-foreground" role="status" aria-label="loading"></span>
          <span x-text="loading ? 'Loading...' : 'Add Variant'"></span>
        </button>
      </div>

    </fieldset>
  </form>
</div>

<?= $this->endSection() ?>