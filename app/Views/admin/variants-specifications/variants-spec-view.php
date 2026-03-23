<?= $this->extend("admin/layout/control-panel"); ?>
<?= $this->section("page") ?>

<div x-data="VariantAddSpec('<?= csrf_hash() ?>', '<?= $id ?>')" class="w-full max-w-3xl space-y-3">

  <!-- Page Header -->
  <div class="flex items-center justify-between mb-5">
    <div>
      <h2 class="text-base font-semibold text-gray-800">Variant specifications</h2>
      <p class="text-sm text-gray-500 mt-0.5">Configure specifications for this vehicle variant</p>
    </div>
  </div>

  <!-- ── Variant Info Banner ─────────────────────────────────────── -->
  <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 mb-6">
    <i class="fa-solid fa-hexagon-nodes text-gray-400"></i>
    <div class="text-sm">
      <span class="font-medium text-gray-800"><?= esc($cc->vehicle_title) ?></span>
      <?php if (!empty($cc->variant_model)): ?>
        <span class="text-gray-400 ml-2">&mdash; <?= esc($cc->variant_model) ?></span>
      <?php endif; ?>
    </div>
  </div>

  <!-- Validation Errors -->
  <template x-if="validation">
    <div class="flex gap-3 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-800" role="alert">
      <svg class="shrink-0 size-4 mt-0.5 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <path d="m15 9-6 6" />
        <path d="m9 9 6 6" />
      </svg>
      <div>
        <p class="font-semibold text-sm">Please fix the following errors before continuing.</p>
        <ul class="mt-2 list-disc ps-4 space-y-1 text-red-700">
          <template x-for="(value, index) in validation">
            <li x-text="value"></li>
          </template>
        </ul>
      </div>
    </div>
  </template>

  <!-- Add Specification Card -->
  <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm">
    <div class="px-5 py-4 border-b border-gray-100">
      <p class="text-sm font-semibold text-gray-800">Add specification</p>
      <p class="text-xs text-gray-500 mt-0.5">Select a category and specification type to add</p>
    </div>
    <form @submit.prevent="addSpecification($event)" id="variant-specification" action="/api/variants-specifications" class="px-5 py-4">
      <input type="hidden" name="csrf_token" :value="csrf_token">
      <input type="hidden" name="variant" value="<?= $id ?>">
      <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto] gap-3 items-end">
        <div>
          <label class="block text-xs font-medium text-gray-700 mb-1.5">Category</label>
          <select x-ref="spec_cat_ref" name="spec_cat"
            class="py-2 px-3 block w-full text-sm border border-gray-200 rounded-lg bg-white focus:border-primary-500 focus:ring-primary-500">
            <?php foreach ($spec_categories as $row): ?>
              <option value="<?= $row->scat_no ?>"><?= $row->scat_title ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-700 mb-1.5">Specification</label>
          <select x-ref="spec_type_ref" name="spec_type"
            class="py-2 px-3 block w-full text-sm border border-gray-200 rounded-lg bg-white focus:border-primary-500 focus:ring-primary-500">
            <?php foreach ($spec_type as $row): ?>
              <option value="<?= $row->spec_no ?>"><?= $row->spec_title ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button :disabled="loading" type="submit"
          class="py-2 px-4 inline-flex items-center gap-x-1.5 text-sm font-medium rounded-lg bg-gray-900 text-white hover:bg-gray-700 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
          <span x-show="loading" class="animate-spin size-3.5 border-2 border-current border-t-transparent rounded-full"></span>
          <svg x-show="!loading" class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
          </svg>
          <span x-text="loading ? 'Adding...' : 'Add'"></span>
        </button>
      </div>
    </form>
  </div>

  <!-- Specifications List Card -->

  <div class="bg-white border border-gray-100 rounded-xl overflow-hidden shadow-sm">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
      <div>
        <p class="text-sm font-semibold text-gray-800">
          Specifications
        </p>
        <p class="text-xs text-gray-500 mt-0.5">Check a spec to include it, then fill in its value</p>
      </div>
      <div x-show="updating" class="animate-spin inline-block size-6 border-3 border-current border-t-transparent rounded-[999px] text-primary" role="status" aria-label="loading">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <template x-for="category in data">
      <div x-data="{ open: true }" class="border-b border-gray-100 last:border-b-0">
        <!-- Category Header -->
        <button type="button" @click="open = !open"
          class="w-full flex items-center justify-between px-5 py-3 bg-gray-50 hover:bg-gray-100 transition-colors text-left">
          <span x-text="category.title" class="text-xs font-semibold uppercase tracking-wide text-gray-500"></span>
          <svg :class="open ? 'rotate-180' : ''" class="size-4 text-gray-400 transition-transform duration-200"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="m6 9 6 6 6-6" />
          </svg>
        </button>

        <!-- Spec Rows -->
        <div x-show="open" x-collapse class="divide-y divide-gray-50">
          <template x-for="item in category.items" :key="item.vsc_no">
            <div class="grid grid-cols-2 gap-3 items-center px-5 py-3">
              <label class="flex items-center gap-3 cursor-pointer">
                <!-- <input type="checkbox" name="specs[]" class="size-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"> -->
                <div>
                  <p x-text="item.spec_title" class="text-sm text-gray-800"></p>
                  <p class="text-xs text-gray-400"></p>
                </div>
              </label>

              <div class="flex gap-1">
                <input
                  :value="item.vs_value"
                  @input="updateSpecification($event.target.value, `api/variants-specifications/${item.vs_no}`)"
                  type="text" name="spec_value[]"
                  placeholder="Enter value..."
                  class="py-1.5 px-3 text-sm border border-gray-200 rounded-lg bg-gray-50 text-gray-800 focus:bg-white focus:border-primary-500 focus:ring-primary-500 w-full">
                <button @click="deleteSpecification(item.vsc_no, item.vs_no, `api/variants-specifications/${item.vs_no}`)"><i class="fa-solid fa-trash"></i></button>
              </div>
            </div>
          </template>
        </div>
      </div>
    </template>
    <?php foreach ($spec_categories as $category): ?>
    <?php endforeach; ?>
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

  <!-- Footer Actions -->
  <div class="flex items-center justify-between pt-4">
    <div class="flex gap-2">
      <button type="button" class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">
        Cancel
      </button>
    </div>
  </div>
</div>

<?= $this->endSection() ?>