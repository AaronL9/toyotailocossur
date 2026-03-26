<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<nav class="mb-5" aria-label="Breadcrumb">
  <ol class="flex items-center gap-1.5 text-sm text-gray-500">
    <li><a href="/admin/vehicles" class="hover:text-gray-800 transition-colors">Vehicles</a></li>
    <li><svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="m9 18 6-6-6-6" />
      </svg></li>
    <li class="font-medium text-gray-800"><?= esc($cc->vehicle_title) ?></li>
  </ol>
</nav>

<div class="w-full mx-auto" x-data="variantsData('<?= csrf_hash() ?>', '<?= esc($cc->vehicle_no) ?>')" x-init="init()">

  <!-- Vehicle banner -->
  <div class="flex items-center gap-4 bg-white border border-gray-200 rounded-xl p-5 mb-6">

    <!-- Icon -->
    <div class="size-14 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
      <svg class="size-7 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M5 17H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h1m15 10h2a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-1M8 17h8M7 9l1-4h8l1 4" />
        <circle cx="7.5" cy="17.5" r="1.5" />
        <circle cx="16.5" cy="17.5" r="1.5" />
      </svg>
    </div>

    <!-- Info -->
    <div class="flex-1 min-w-0">
      <p class="text-lg font-medium text-gray-900 leading-tight"><?= esc($cc->vehicle_title) ?></p>
      <p class="text-sm text-gray-500 mt-0.5"><?= esc($cc->vehicle_tagline) ?></p>
    </div>

  </div>

  <!-- Variants section header -->
  <div class="flex items-center justify-between gap-3 mb-4">
    <div class="flex items-center gap-3 flex-1">
      <p class="text-sm font-medium text-gray-800 whitespace-nowrap">
        Variants
        <span x-text="'(' + pagination.total + ')'" class="font-normal text-gray-400 text-xs ml-1"></span>
      </p>

      <!-- Search -->
      <div class="relative max-w-xs w-full">
        <label for="variant-search" class="sr-only">Search variants</label>
        <input @keyup.enter="search($event)" type="text" id="variant-search"
          class="py-1.5 px-3 ps-9 block w-full bg-layer border-layer-line shadow-2xs rounded-lg text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
          placeholder="Search variants…">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
          <svg class="size-3.5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </div>
      </div>
    </div>

    <a href="/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>/variant-create"
      class="inline-flex items-center gap-1.5 text-sm font-medium py-1.5 px-3 rounded-lg bg-gray-900 text-white hover:bg-gray-700 transition-colors whitespace-nowrap">
      <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M12 5v14M5 12h14" />
      </svg>
      Add variant
    </a>
  </div>

  <!-- Loading -->
  <template x-if="loading">
    <div class="flex justify-center py-16">
      <div class="animate-spin size-8 border-3 border-current border-t-transparent rounded-full text-primary-600" role="status">
        <span class="sr-only">Loading…</span>
      </div>
    </div>
  </template>

  <!-- Variant cards grid -->
  <template x-if="!loading">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">

      <!-- Empty state -->
      <template x-if="variants.length === 0">
        <div class="col-span-full text-center py-16 text-gray-400 text-sm">
          No variants yet.
          <a href="/admin/vehicles/<?= $cc->vehicle_no ?>/variants/create" class="text-primary-600 hover:underline ml-1">Add the first one.</a>
        </div>
      </template>

      <!-- Variant card -->
      <template x-for="variant in variants" :key="variant.id">
        <div class="flex flex-col gap-2.5 bg-white border border-gray-200 rounded-xl p-4 hover:border-gray-300 transition-colors">

          <div class="flex items-center justify-between">
            <div class="inline-flex items-center gap-1.5">
              <template x-if="variant.isdefault">
                <span class="inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full border bg-amber-50 text-amber-700 border-amber-100">
                  <i class="fa-solid fa-star text-[9px]"></i>
                  Default
                </span>
              </template>
              <span :class="!variant.inactive ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-gray-100 text-gray-500 border-gray-200'"
                class="text-[11px] font-medium px-2 py-0.5 rounded-full border"
                x-text="!variant.inactive ? 'Active' : 'Inactive'">
              </span>
            </div>
            <label class="relative inline-block w-9 h-5 cursor-pointer">
              <input type="checkbox" class="peer sr-only"
                :checked="!variant.inactive"
                @change="toggleVariant(variant.id, $event.target.checked)">
              <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors peer-checked:bg-primary-600"></span>
              <span class="absolute top-0.5 start-0.5 size-4 bg-white rounded-full shadow-xs transition-transform peer-checked:translate-x-4"></span>
            </label>
          </div>

          <!-- Name + subtitle -->
          <div>
            <p x-text="variant.model" class="text-sm font-medium text-gray-900 leading-snug"></p>
            <p x-text="variant.sub" class="text-xs text-gray-500 mt-0.5"></p>
          </div>

          <!-- Price -->
          <p x-text="variant.price" class="text-sm font-medium text-gray-900"></p>

          <!-- Color/attribute chips -->
          <div class="flex flex-wrap gap-1">
            <template x-for="attr in variant.attrs" :key="attr">
              <span x-text="attr"
                class="text-[11px] px-2 py-0.5 rounded-md bg-gray-100 text-gray-500 border border-gray-200">
              </span>
            </template>
          </div>

          <hr class="border-gray-100">

          <!-- Actions -->
          <!-- Actions -->
          <div class="flex items-center justify-between pt-0.5">
            <div class="inline-flex items-center gap-x-1">
              <a x-bind:href="`/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>/variant/specifications/${variant.id}`"
                class="size-8 inline-flex items-center justify-center rounded-lg border border-transparent text-gray-400 hover:bg-gray-100 hover:text-gray-700 focus:outline-hidden transition-colors"
                title="Specifications">
                <i class="fa-solid fa-rectangle-list text-sm"></i>
              </a>
              <a x-bind:href="`/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>/variant/gallery/${variant.id}`"
                class="size-8 inline-flex items-center justify-center rounded-lg border border-transparent text-gray-400 hover:bg-gray-100 hover:text-gray-700 focus:outline-hidden transition-colors"
                title="Gallery">
                <i class="fa-solid fa-images text-sm"></i>
              </a>
              <a x-bind:href="`/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>/variant/photo/${variant.id}`"
                class="size-8 inline-flex items-center justify-center rounded-lg border border-transparent text-gray-400 hover:bg-gray-100 hover:text-gray-700 focus:outline-hidden transition-colors"
                title="Photo">
                <i class="fa-solid fa-camera text-sm"></i>
              </a>
            </div>

            <div class="inline-flex items-center gap-x-1">
              <a x-bind:href="`/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>/variant-edit/${variant.id}`"
                class="size-8 inline-flex items-center justify-center rounded-lg border border-transparent text-gray-400 hover:bg-orange-50 hover:text-orange-500 focus:outline-hidden transition-colors"
                title="Edit">
                <i class="fa-solid fa-pen-to-square text-sm"></i>
              </a>
              <button @click="deleteVariant(variant.id)" type="button"
                class="size-8 inline-flex items-center justify-center rounded-lg border border-transparent text-gray-400 hover:bg-red-50 hover:text-red-500 focus:outline-hidden transition-colors"
                title="Delete">
                <i class="fa-solid fa-trash text-sm"></i>
              </button>
            </div>
          </div>

        </div>
      </template>
    </div>
  </template>

  <!-- Footer: count + pagination -->
  <div class="flex justify-between items-center mt-5">
    <p class="text-sm text-gray-500">
      <span x-text="pagination.total" class="font-medium text-gray-800"></span> results
    </p>
    <nav class="flex items-center gap-x-1" aria-label="Pagination">
      <button @click="prev($event)" x-bind:data-uri="pagination.previous" type="button"
        :disabled="!pagination.previous"
        class="size-9 inline-flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-100 disabled:opacity-40 disabled:pointer-events-none" aria-label="Previous">
        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
      <div class="flex items-center gap-x-1 text-sm text-gray-500">
        <span x-text="pagination.currentPage" class="min-w-8 text-center border border-gray-200 text-gray-800 py-1.5 px-2 rounded-lg"></span>
        <span>of</span>
        <span x-text="pagination.pageCount"></span>
      </div>
      <button @click="next($event)" x-bind:data-uri="pagination.next" type="button"
        :disabled="!pagination.next"
        class="size-9 inline-flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-100 disabled:opacity-40 disabled:pointer-events-none" aria-label="Next">
        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="m9 18 6-6-6-6" />
        </svg>
      </button>
    </nav>
  </div>

</div>

<script>
  window.APP = {
    flash: <?= json_encode(session()->getFlashdata()) ?>
  }
</script>
<?= $this->endSection() ?>