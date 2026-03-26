<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>
<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div class="w-full mx-auto" x-data="vehiclesData('<?= csrf_hash() ?>')">

  <!-- Header -->
  <div class="flex justify-between items-center gap-3 mb-5">
    <div class="relative max-w-xs flex-1">
      <label for="hs-table-search" class="sr-only">Search</label>
      <input @keyup="search($event)" type="text" id="hs-table-search"
        class="py-2 px-3 ps-9 block w-full bg-layer border-layer-line shadow-2xs rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
        placeholder="Search vehicles…">
      <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
        <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8" />
          <path d="m21 21-4.3-4.3" />
        </svg>
      </div>
    </div>

    <a href="/admin/vehicles/create"
      class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden">
      <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M12 5v14M5 12h14" />
      </svg>
      Add vehicle
    </a>
  </div>

  <!-- Loading state -->
  <template x-if="loading">
    <div class="flex justify-center py-16">
      <div class="animate-spin inline-block size-8 border-3 border-current border-t-transparent rounded-full text-primary-600" role="status">
        <span class="sr-only">Loading…</span>
      </div>
    </div>
  </template>

  <!-- Card grid -->
  <template x-if="!loading">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

      <!-- Empty state -->
      <template x-if="vehicles.length === 0">
        <div class="col-span-full text-center py-16 text-gray-400 text-sm">
          No vehicles found.
        </div>
      </template>

      <!-- Vehicle cards -->
      <template x-for="vehicle in vehicles" :key="vehicle.id">
        <div class="flex flex-col gap-3 bg-white border border-gray-200 rounded-xl p-4 hover:border-accent-800 transition-colors">

          <!-- Card top: icon + toggle -->
          <div class="flex items-start justify-between">
            <div class="size-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500">
              <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M5 17H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h1m15 10h2a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-1M8 17h8M7 9l1-4h8l1 4" />
                <circle cx="7.5" cy="17.5" r="1.5" />
                <circle cx="16.5" cy="17.5" r="1.5" />
              </svg>
            </div>

            <!-- Active toggle -->
            <label class="relative inline-block w-11 h-6 cursor-pointer">
              <input type="checkbox" class="peer sr-only" :checked="!vehicle.inactive" @change="toggleActive(vehicle.id, $event.target.checked)">
              <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors peer-checked:bg-primary-600"></span>
              <span class="absolute top-0.5 start-0.5 size-5 bg-white rounded-full shadow-xs transition-transform peer-checked:translate-x-5"></span>
            </label>
          </div>

          <!-- Name & tagline -->
          <div>
            <p x-text="vehicle.name" class="text-sm font-medium text-gray-900 leading-snug"></p>
            <p x-text="vehicle.tagline" class="text-xs text-gray-500 mt-0.5 truncate"></p>
          </div>

          <!-- Category badges -->
          <div class="flex flex-wrap gap-1.5">
            <template x-for="cat in vehicle.categories" :key="cat">
              <span x-text="cat" class="text-[11px] px-2 py-0.5 rounded-full bg-gray-100 text-gray-500 border border-gray-200"></span>
            </template>
          </div>

          <hr class="border-gray-100">

          <!-- Actions -->
          <div class="flex gap-2 mt-auto">
            <!-- Variants -->
            <a :href="`/admin/vehicles/${vehicle.uri}`"
              class="flex-1 inline-flex items-center justify-center gap-1.5 text-xs font-medium py-1.5 px-2.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
              <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6h16M4 12h16M4 18h7" />
                <path d="m15 15 3 3 3-3m-3-3v6" />
              </svg>
              Variants
            </a>

            <!-- Edit -->
            <a :href="`/admin/vehicles/edit/${vehicle.id}`"
              class="flex-1 inline-flex items-center justify-center gap-1.5 text-xs font-medium py-1.5 px-2.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
              <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z" />
              </svg>
              Edit
            </a>

            <!-- Delete -->
            <button @click="deleteRow(vehicle.id)" type="button"
              class="inline-flex items-center justify-center p-1.5 rounded-lg border border-gray-200 text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors">
              <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6" />
                <path d="M19 6 18 20H6L5 6m5 0V4h4v2" />
              </svg>
            </button>
          </div>

        </div>
      </template>
    </div>
  </template>

  <!-- Footer: count + pagination -->
  <div class="flex justify-between items-center mt-5">
    <p class="text-sm text-gray-500">
      <span x-text="pageDetails.total" class="font-medium text-gray-800"></span> results
    </p>

    <nav class="flex items-center gap-x-1" aria-label="Pagination">
      <button @click="prev($event)" x-bind:data-uri="pageDetails.previous" type="button"
        class="size-9 inline-flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-100 disabled:opacity-40 disabled:pointer-events-none" aria-label="Previous">
        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
      <div class="flex items-center gap-x-1 text-sm text-gray-500">
        <span x-text="pageDetails.currentPage" class="min-w-8 text-center border border-gray-200 text-gray-800 py-1.5 px-2 rounded-lg"></span>
        <span>of</span>
        <span x-text="pageDetails.pageCount"></span>
      </div>
      <button @click="next($event)" x-bind:data-uri="pageDetails.next" type="button"
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