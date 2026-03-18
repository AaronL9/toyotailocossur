<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div class="w-full mx-auto">
  <div x-data="VehicleCategoryTable('<?= csrf_hash() ?>')" class="flex flex-col border min-w-full border-gray-200 rounded-lg px-5 py-5 mx-auto min-h-[calc(100vh-250px)]">
    <!-- Header -->
    <div class="mb-5 flex justify-between">
      <div class="relative max-w-xs">
        <label for="hs-table-search" class="sr-only">Search</label>
        <input @keyup.enter="search($event)" type="text" name="hs-table-search" id="hs-table-search" class="py-1.5 sm:py-2 px-3 ps-9 block w-full bg-layer border-layer-line shadow-2xs rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:z-10 focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for variants">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
          <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </div>
      </div>

      <a href="/admin/variants/create" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-governance-form-modal" data-hs-overlay="#hs-governance-form-modal">
        Add
      </a>
    </div>

    <!-- End Header -->

    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full min-h-full inline-block align-middle">
        <div class="overflow-hidden">
          <table id="users-table" class="min-w-full h-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th scope="col" class="px-2 py-3 text-start text-xs font-medium text-gray-500 uppercase"></th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Model</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Type</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Price</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Base Model</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Alpine for directives -->
              <template x-if="!loading">
                <template x-for="row in data" :key="row.variant_no">
                  <tr class="odd:bg-white even:bg-gray-100">
                    <td class="px-2 py-3 whitespace-nowrap">
                      <label class="relative inline-block w-11 h-6 cursor-pointer">
                        <input type="checkbox" class="peer sr-only">
                        <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary -600 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full"></span>
                      </label>
                    </td>
                    <td x-text="row.variant_model" class="px-6 py-3 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="row.vehicle_title" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="$store.helper.formatNumber(row.variant_price)" class="px-6 py-3 whitespace-nowrap text-sm text-gray-800"></td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-800">
                      <i x-show="row.variant_isdefault === '1'" class="fa-solid fa-circle-check text-green-700"></i>
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap text-end text-sm font-medium">
                      <div class="inline-flex gap-x-2">
                        <a x-bind:href="`/admin/variants/specifications/${row.variant_no}`" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary-600 hover:text-blue-400 focus:outline-hidden">
                          <i class="fa-solid fa-rectangle-list"></i>
                        </a>
                        <a x-bind:href="`/admin/variants/gallery/${row.variant_no}`" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary-600 hover:text-blue-400 focus:outline-hidden">
                          <i class="fa-solid fa-images"></i>
                        </a>
                        <a x-bind:href="`/admin/variants/photo/${row.variant_no}`" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary-600 hover:text-blue-400 focus:outline-hidden">
                          <i class="fa-solid fa-camera"></i>
                        </a>
                        <a x-bind:href="`/admin/variants/${row.variant_no}`" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-primary-600 hover:text-orange-400 focus:outline-hidden">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <button @click="deleteRow(row.variant_no)" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-neutral-600 hover:text-red-500 focus:outline-hidden del-btn">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </template>
              </template>

              <!-- Alpine if directives  -->
              <template x-if="loading">
                <tr>
                  <td class="text-center py-5" colspan="6">
                    <div class="animate-spin inline-block size-8 border-3 border-current border-t-transparent rounded-[999px] text-primary-600 m-auto" role="status" aria-label="loading">
                      <span class="sr-only">Loading...</span>
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="flex justify-between items-center mt-auto">
      <p class="h-0">
        <span x-text="pagination.total" class="font-medium"></span>
        <span class="font-light">results</span>
      </p>
      <!-- Pagination -->
      <nav class="flex items-center gap-x-1 mt-5" aria-label="Pagination">
        <button @click="prev($event)" x-bind:data-uri="pagination.previous" type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none" aria-label="Previous">
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6" />
          </svg>
          <span class="sr-only">Previous</span>
        </button>

        <div class="flex items-center gap-x-1">
          <span x-text="pagination.currentPage" class="min-h-9.5 min-w-9.5 flex justify-center items-center border border-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">1</span>
          <span class="min-h-9.5 flex justify-center items-center text-gray-500 py-2 px-1.5 text-sm">of</span>
          <span x-text="pagination.pageCount" id="total-page" class="min-h-9.5 flex justify-center items-center text-gray-500 py-2 px-1.5 text-sm">1</span>
        </div>

        <button @click="next($event)" x-bind:data-uri="pagination.next" type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none" aria-label="Next">
          <span class="sr-only">Next</span>
          <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
          </svg>
        </button>
      </nav>
      <!-- End Pagination -->
    </div>
  </div>
</div>
<?= $this->endSection() ?>