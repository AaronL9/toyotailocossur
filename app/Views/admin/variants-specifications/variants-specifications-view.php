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
            @change="onSpecCatChangeHandler($event)"
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
            @change="onSpecTypeChangeHandler($event)"
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

  <?php if (count($cc)): ?>
    <!-- Specs Table -->
    <div class="rounded-lg border border-gray-200 overflow-hidden mt-1 min-h-[150px] max-h-[500px] overflow-y-auto">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50 sticky top-0 z-10">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Specification</th>
            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Value</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
          <?php foreach ($cc as $row): ?>
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-4 py-3 text-gray-500 whitespace-nowrap"><?= $row->scat_title ?></td>
              <td class="px-4 py-3 font-medium text-gray-800 whitespace-nowrap"><?= $row->spec_title ?></td>
              <td class="px-4 py-3 text-gray-700 whitespace-nowrap">
                <span><?= $row->vs_value ?></span>
              </td>
              <td class="px-4 py-3 text-right">
                <button type="button" @click="removeSpec(spec.vs_id)" class="text-gray-400 hover:text-red-500 transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18" />
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                  </svg>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <?php if (!count($cc)): ?>
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
  <?php endif; ?>

  <pre>
      <?php // print_r($cc); 
      ?>
    </pre>

  </fieldset>
  </form>
</div>

<?= $this->endSection() ?>