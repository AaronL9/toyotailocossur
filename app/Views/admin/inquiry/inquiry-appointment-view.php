<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div class="w-full mx-auto">
  <!-- Page Header -->
  <div class="flex items-center gap-x-3 mb-5">
    <a href="/admin/inquiry" class="inline-flex items-center justify-center size-9 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 hover:text-gray-800 focus:outline-none">
      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />
      </svg>
    </a>
    <div>
      <h1 class="text-lg font-semibold text-gray-800">Service Appointment Scheduling</h1>
      <p class="text-sm text-gray-500">Manage and view all service appointment requests.</p>
    </div>
  </div>
  <!-- End Page Header -->

  <div x-data="InquiryAppointmentTable('<?= csrf_hash() ?>')" class="flex flex-col border min-w-full border-gray-200 rounded-lg px-5 py-5 mx-auto">
    <!-- Header -->
    <div class="mb-5 flex justify-between">
      <div class="relative max-w-xs">
        <label for="hs-table-search" class="sr-only">Search</label>
        <input @keyup.enter="search($event)" type="text" name="hs-table-search" id="hs-table-search" class="py-1.5 sm:py-2 px-3 ps-9 block w-full bg-layer border-layer-line shadow-2xs rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:z-10 focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none" placeholder="search...">
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
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Contact</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Appointment Date</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Appointment Time</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Requested Date</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Alpine for directives -->
              <template x-if="!loading">
                <template x-for="inquiry in data" :key="inquiry.id">
                  <tr class="odd:bg-white even:bg-gray-100">
                    <td x-text="inquiry.inquirer" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="inquiry.email" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="inquiry.contact" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="$store.helper.formatDate(inquiry.appointment_date)" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="$store.helper.formatTime(inquiry.appointment_time)" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td x-text="$store.helper.formatDate(inquiry.date)" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                    <td class="px-6 py-3 whitespace-nowrap text-end text-sm font-medium">
                      <a x-bind:href="`/admin/inquiry/contact/${inquiry.id}`" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-accent-600 hover:text-accent-400 focus:outline-hidden" title="View">
                        <i class="fa-solid fa-eye"></i>
                      </a>
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