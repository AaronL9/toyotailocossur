<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div x-data="VariantsSpecificationsData('<?= csrf_hash() ?>', '/api/variants-specifications', '<?= $id ?>')" class="flex flex-row-reverse flex-wrap justify-end gap-3 w-full">

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

  <form @submit.prevent="add($event)" id="variant-specification" action="/api/variants-specifications">
    <!-- Specifications -->
    <fieldset class="flex flex-col gap-4 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6 mt-4">
      <input type="hidden" name="csrf_token" :value="csrf_token">
      <input type="hidden" name="variant" value="<?= $id ?>">
      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Specifications</legend>

      <!-- Input Row -->
      <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_1fr_auto] gap-3 items-end">

        <!-- Category -->
        <div>
          <label class="block text-sm font-medium mb-2">Category</label>
          <select
            x-ref="spec_cat_ref"
            name="spec_cat"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm bg-white focus:border-primary-500 focus:ring-primary-500">
            <?php foreach ($spec_categories as $row): ?>
              <option value="<?= $row->scat_no ?>"><?= $row->scat_title ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Spec -->
        <div>
          <label class="block text-sm font-medium mb-2">Specification</label>
          <select
            x-ref="spec_type_ref"
            name="spec_type"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm bg-white focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
            <?php foreach ($spec_type as $row): ?>
              <option value="<?= $row->spec_no ?>"><?= $row->spec_title ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Order -->
        <div>
          <label class="text-sm font-medium mb-2">Order</label>
          <div class="relative">
            <input
              type="number"
              name="order"
              class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>

        <!-- Value -->
        <div>
          <label class="block text-sm font-medium mb-2">Value</label>
          <div class="relative">
            <input
              type="text"
              @keydown.enter.prevent="addSpec()"
              name="vs_value"
              class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
          </div>
        </div>

        <!-- Add Button -->
        <div>
          <button
            :disabled="loading"
            type="submit"
            class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none">
            <span x-show="loading" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent rounded-[999px] text-primary-foreground" role="status" aria-label="loading"></span>
            <span x-text="loading ? 'Loading...' : 'Add'"></span>
          </button>
        </div>
      </div>
  </form>

  <!-- Duplicate Warning -->
  <template x-if="!isValid">
    <p x-text="validationMessage" class="text-xs text-amber-600 -mt-1"></p>
  </template>

  <!-- Specs Table -->
  <div class="rounded-lg border border-gray-200 overflow-hidden mt-1 min-h-[150px] max-h-[500px] overflow-y-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead class="bg-gray-50 sticky top-0 z-10">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"></th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Specification</th>
          <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Value</th>
          <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 bg-white">
        <template x-for="row in data" :key="row.vsc_no">
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-2 py-3 whitespace-nowrap">
              <label class="relative inline-block w-11 h-6 cursor-pointer">
                <input type="checkbox" class="peer sr-only" @click="onSwitch(row.vs_inactive, row.vs_no)" x-bind:checked="!Boolean(parseInt(row.vs_inactive))">
                <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary -600 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                <span class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full"></span>
              </label>
            </td>
            <td class="px-4 py-3 text-gray-500 whitespace-nowrap" x-text="row.scat_title"></td>
            <td class="px-4 py-3 font-medium text-gray-800 whitespace-nowrap" x-text="row.spec_title"></td>
            <td class="px-4 py-3 text-gray-700 whitespace-nowrap">
              <span x-text="row.vs_value"></span>
            </td>
            <td class="px-4 py-3 text-right">
              <!-- Edit button -->
              <button
                type="button"
                @click="edit(row.vs_no, row)"
                class="mr-2 text-gray-400 hover:text-blue-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 3 21l.5-4.5L17 3z" />
                </svg>
              </button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>

  <?php if (!count($cc)): ?>
    <!-- Empty State -->
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
  <?php endif; ?>

  <!-- Edit value modal template (similar to specifications-category-view) -->
  <template id="swal-variant-spec-modal">
    <swal-html>
      <h3 class="text-base font-semibold text-left text-gray-800">
        <i class="fa-solid fa-pen-to-square text-primary-900 mr-2"></i>Edit Specification Value
      </h3>

      <!-- Divider -->
      <hr class="border-t border-gray-100 my-4" />

      <!-- Specification select -->
      <div class="mb-4">
        <label class="block text-sm text-left font-medium text-gray-700 mb-1">Specification</label>
        <select
          x-model="$store.variantSpec.editSpecNo"
          id="edit-variant-spec-select"
          class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm bg-white focus:border-primary-500 focus:ring-primary-500">
          <?php foreach ($spec_type as $row): ?>
            <option value="<?= $row->spec_no ?>"><?= $row->spec_title ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Input -->
      <div class="mb-4">
        <label class="block text-sm text-left font-medium text-gray-700 mb-1">Value</label>
        <input
          x-model="$store.variantSpec.editInput"
          type="text"
          id="edit-variant-spec-input"
          class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
          placeholder="Edit specification value..." />
      </div>
    </swal-html>

    <swal-footer>
      <div class="flex justify-end gap-x-2">
        <button
          @click="$store.Swal.close()"
          type="button"
          class="py-2 px-4 inline-flex items-center gap-x-1.5 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 transition-colors duration-150">
          <i class="fa-solid fa-xmark text-xs"></i> Cancel
        </button>
        <button
          @click="$store.Swal.clickConfirm()"
          type="button"
          class="py-2 px-4 inline-flex items-center gap-x-1.5 text-sm font-medium rounded-lg bg-primary-950 text-white hover:bg-primary-900 transition-colors duration-150">
          <i class="fa-solid fa-floppy-disk text-xs"></i> Save
        </button>
      </div>
    </swal-footer>

    <swal-param
      name="customClass"
      value='{ "footer": "border-none! pt-0! mt-0!" }' />
  </template>

  </fieldset>
  </form>

  <pre>
    <?php // print_r($cc)
    ?>
  </pre>
</div>

<?= $this->endSection() ?>