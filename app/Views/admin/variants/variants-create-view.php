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

    <!-- Variant Details -->
    <fieldset class="flex flex-col gap-5 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6">
      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Vehicle Variant Details</legend>

      <!-- Vehicle -->
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
              type="number" id="price" name="price" min="0" step="0.01" placeholder="0.00"
              class="py-2.5 sm:py-3 pl-12 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
        <div>
          <label for="price_month" class="block text-sm font-medium mb-2">Price (Monthly)</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 text-sm pointer-events-none">RM</span>
            <input
              type="number" id="price_month" name="price_month" min="0" step="0.01" placeholder="0.00"
              class="py-2.5 sm:py-3 pl-12 pr-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>
      </div>

      <!-- Toggles -->
      <div class="flex flex-col sm:flex-row gap-4">
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
            <input type="checkbox" id="isdefault" name="isdefault" value="1" class="sr-only peer">
            <div class="w-10 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary-600 transition-colors duration-200 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-4"></div>
          </div>
        </label>
      </div>

    </fieldset>

    <!-- Specifications -->
    <fieldset class="flex flex-col gap-4 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6 mt-4">

      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Specifications</legend>

      <!-- Input Row -->
      <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_1fr_auto] gap-3 items-end">

        <!-- Category -->
        <div>
          <label class="block text-sm font-medium mb-2">Category</label>
          <select
            x-model="selectedCategory"
            @change="selectedSpec = ''; specValue = ''"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm bg-white focus:border-primary-500 focus:ring-primary-500">
            <option value="" disabled>Select category...</option>
            <?php foreach ($spec_categories as $row): ?>
              <option value="<?= $row->scat_no ?>"><?= $row->scat_title ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Spec -->
        <div>
          <label class="block text-sm font-medium mb-2">Specification</label>
          <select
            x-model="selectedSpec"
            :disabled="!selectedCategory"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm bg-white focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
            <option value="" disabled>Select spec...</option>
            <template x-for="spec in filteredSpecs" :key="spec.spec_no">
              <option :value="spec.spec_no" x-text="spec.spec_name + (spec.spec_unit ? ' (' + spec.spec_unit + ')' : '')"></option>
            </template>
          </select>
        </div>

        <!-- Value -->
        <div>
          <label class="block text-sm font-medium mb-2">Value</label>
          <div class="relative">
            <input
              type="text"
              x-model="specValue"
              :disabled="!selectedSpec"
              @keydown.enter.prevent="addSpec()"
              :placeholder="selectedSpecUnit ? 'e.g. 120 ' + selectedSpecUnit : 'Enter value...'"
              class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
            <span
              x-show="selectedSpecUnit"
              x-text="selectedSpecUnit"
              class="absolute inset-y-0 right-3 flex items-center text-xs text-gray-400 pointer-events-none">
            </span>
          </div>
        </div>

        <!-- Add Button -->
        <div>
          <button
            type="button"
            @click="addSpec()"
            :disabled="!selectedCategory || !selectedSpec || !specValue.trim() || isDuplicate"
            class="w-full py-2.5 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="M12 5v14" />
            </svg>
            Add
          </button>
        </div>

      </div>

      <!-- Duplicate Warning -->
      <template x-if="isDuplicate">
        <p class="text-xs text-amber-600 -mt-1">This spec has already been added.</p>
      </template>

      <!-- Specs Table -->
      <template x-if="addedSpecs.length > 0">
        <div class="rounded-lg border border-gray-200 overflow-hidden mt-1">
          <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Specification</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Value</th>
                <th class="px-4 py-3"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
              <template x-for="spec in addedSpecs" :key="spec.spec_no">
                <tr class="hover:bg-gray-50 transition-colors">
                  <td class="px-4 py-3 text-gray-500 whitespace-nowrap" x-text="spec.category"></td>
                  <td class="px-4 py-3 font-medium text-gray-800 whitespace-nowrap" x-text="spec.spec_name"></td>
                  <td class="px-4 py-3 text-gray-700 whitespace-nowrap">
                    <span x-text="spec.value"></span>
                    <span x-show="spec.spec_unit" class="text-gray-400 text-xs ml-1" x-text="spec.spec_unit"></span>
                  </td>
                  <td class="px-4 py-3 text-right">
                    <button type="button" @click="removeSpec(spec.spec_no)" class="text-gray-400 hover:text-red-500 transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                      </svg>
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </template>

      <!-- Empty State -->
      <template x-if="addedSpecs.length === 0">
        <div class="flex flex-col items-center justify-center py-8 text-center border border-dashed border-gray-200 rounded-lg mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-gray-300 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
            <rect x="9" y="3" width="6" height="4" rx="1" />
            <path d="M9 12h6" />
            <path d="M9 16h4" />
          </svg>
          <p class="text-sm text-gray-400">No specifications added yet.</p>
          <p class="text-xs text-gray-300 mt-0.5">Select a category and spec above, then click Add.</p>
        </div>
      </template>

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