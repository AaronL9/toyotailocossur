<?= $this->extend("admin/layout/control-panel"); ?>


<?= $this->section("page") ?>
<div class="w-full mx-auto">
  <div class="flex flex-col border min-w-full border-gray-200 rounded-lg px-5 py-5 mx-auto">
    <!-- Header -->
    <div class="mb-5 flex justify-between">
      <div class="relative max-w-xs">
        <label for="hs-table-search" class="sr-only">Search</label>
        <input type="text" name="hs-table-search" id="hs-table-search" class="py-1.5 sm:py-2 px-3 ps-9 block w-full bg-layer border-layer-line shadow-2xs rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:z-10 focus:border-primary-focus focus:ring-primary-focus disabled:opacity-50 disabled:pointer-events-none" placeholder="Search for vehicles">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
          <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </div>
      </div>

      <a href="<?= base_url('admin/users/create') ?>" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-governance-form-modal" data-hs-overlay="#hs-governance-form-modal">
        Add
      </a>
    </div>

    <!-- End Header -->

    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden">
          <table id="users-table" class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"></th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tagline</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Price</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody x-data="carsTable">
              <template x-if="loading">
                <tr>
                  <td colspan="3">Loading...</td>
                </tr>
              </template>

              <template x-for="car in cars" :key="car.vehicle_no">
                <tr class="odd:bg-white even:bg-gray-100">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <label class="relative inline-block w-11 h-6 cursor-pointer">
                      <input type="checkbox" class="peer sr-only">
                      <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-primary -600 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                      <span class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full"></span>
                    </label>
                  </td>
                  <td x-text="car.vehicle_title" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800"></td>
                  <td x-text="car.vcat_title" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">100,000</td>
                  <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <div class="inline-flex gap-x-2">
                      <a class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-600 hover:text-green-800 focus:outline-hidden">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <button type="button" data-action="delete" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-hidden del-btn">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <nav class="flex items-center gap-x-1 mt-5 ml-auto" aria-label="Pagination">
      <button type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" aria-label="Previous">
        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6" />
        </svg>
        <span class="sr-only">Previous</span>
      </button>

      <div class="flex items-center gap-x-1">
        <span id="current-page" class="min-h-9.5 min-w-9.5 flex justify-center items-center border border-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">1</span>
        <span class="min-h-9.5 flex justify-center items-center text-gray-500 py-2 px-1.5 text-sm">of</span>
        <span id="total-page" class="min-h-9.5 flex justify-center items-center text-gray-500 py-2 px-1.5 text-sm">1</span>
      </div>

      <button type="button" class="min-h-9.5 min-w-9.5 py-2 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" aria-label="Next">
        <span class="sr-only">Next</span>
        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m9 18 6-6-6-6" />
        </svg>
      </button>
    </nav>
    <!-- End Pagination -->
  </div>

  <div id="hs-vertically-centered-scrollable-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-vertically-centered-scrollable-modal-label">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto h-[calc(100%-56px)] min-h-[calc(100%-56px)] flex items-center">
      <div class="w-full max-h-full overflow-hidden flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto">
        <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
          <h3 id="inquiry-modal-title" class="font-bold text-gray-800">
            Modal title
          </h3>
        </div>
        <div class="p-4 overflow-y-auto">
          <div id="inquiry-modal-body" class="space-y-4">
            <!-- Content -->
          </div>
        </div>
        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200">
          <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-vertically-centered-scrollable-modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.APP = {
    flash: <?= json_encode(session()->getFlashdata()) ?>
  }
</script>
<?= $this->endSection() ?>