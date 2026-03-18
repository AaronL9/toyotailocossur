<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div class="w-full mx-auto">
  <div x-data="InquiryTable('<?= csrf_hash() ?>')" class="flex flex-col border min-w-full border-gray-200 rounded-lg px-5 py-5 mx-auto">
    <!-- Header -->
    <div class="mb-5 flex justify-between">
      <div class="relative max-w-xs">
        <label for="hs-table-search" class="sr-only">Search</label>
        <input @keyup.enter="search($event)" type="text" name="hs-table-search" id="hs-table-search" class="py-1.5 sm:py-2 px-3 ps-9 block w-full bg-layer border-layer-line shadow-2xs rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:z-10 focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for inquiry">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
          <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </div>
      </div>
    </div>
    <!-- End Header -->

    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full min-h-full inline-block align-middle">
        <div class="rounded-lg border border-gray-200 overflow-hidden mt-1 max-h-[calc(100vh-350px)] overflow-y-auto">
          <table id="inquiry-table" class="min-w-full h-full divide-y divide-gray-100">
            <thead class="bg-gray-50 sticky top-0 z-10">
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Plate No.</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Year</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Mileage</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Contact</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Appointment Date</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Alpine for directives -->
              <template x-if="!loading">
                <template x-for="row in data" :key="row.inquiry_no">
                  <tr class="odd:bg-white even:bg-gray-100">
                    <td x-text="row.inquiry_no" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                      <div class="flex flex-col">
                        <span x-text="row.inquiry_name" class="font-medium"></span>
                        <span x-text="row.inquiry_email" class="text-xs text-gray-400"></span>
                      </div>
                    </td>
                    <td x-text="row.inquiry_plateno" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="row.inquiry_year" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                      <span x-text="row.inquiry_milage ? row.inquiry_milage + ' km' : '—'"></span>
                    </td>
                    <td x-text="row.inquiry_contact" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                      <div class="flex flex-col">
                        <span x-text="row.inquiry_appointment_date ?? '—'"></span>
                        <span x-text="row.inquiry_appointment_time ?? ''" class="text-xs text-gray-400"></span>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <template x-if="row.inquiry_inactive == 1">
                        <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                          <span class="size-1.5 inline-block rounded-full bg-red-600"></span>
                          Inactive
                        </span>
                      </template>
                      <template x-if="!row.inquiry_inactive || row.inquiry_inactive == 0">
                        <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-teal-100 text-teal-700">
                          <span class="size-1.5 inline-block rounded-full bg-teal-600"></span>
                          Active
                        </span>
                      </template>
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap text-end text-sm font-medium">
                      <div class="inline-flex gap-x-2">
                        <a x-bind:href="`/admin/inquiries/${row.inquiry_no}`" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-accent-600 hover:text-accent-400 focus:outline-hidden" title="View">
                          <i class="fa-solid fa-eye"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                </template>
              </template>

              <!-- Loading state -->
              <template x-if="loading">
                <tr>
                  <td class="text-center py-5" colspan="9">
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