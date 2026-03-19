<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div x-data="VehicleCreatePage('<?= csrf_hash() ?>')" class="flex flex-row-reverse flex-wrap justify-end gap-3 w-full">
  <template x-if="validation">
    <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4 max-h-fit" role="alert" tabindex="-1" aria-labelledby="hs-with-list-label">
      <div class="flex">
        <div class="shrink-0">
          <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="m15 9-6 6" />
            <path d="m9 9 6 6" />
          </svg>
        </div>
        <div class="ms-4">
          <h3 id="hs-with-list-label" class="text-sm font-semibold">
            A problem has been occurred while submitting your data.
          </h3>
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

  <form @submit.prevent="addVehicle($event)" id="vehicle-add-form" action="/api/vehicle" method="post" class="w-full max-w-3xl">
    <input x-model="csrf_token" type="hidden" name="csrf_token">

    <fieldset class="flex flex-col gap-5 bg-base-200 border-base-300 rounded-box rounded-lg border border-gray-100 px-6 py-6">
      <legend class="text-base font-semibold text-gray-800 px-1 mb-1">Vehicle Details</legend>

      <!-- Vehicle Title -->
      <div>
        <label for="title" class="block text-sm font-medium mb-2">Vehicle Name</label>
        <input
          type="text"
          id="title"
          name="title"
          placeholder="e.g. Toyota Vios"
          class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
      </div>

      <!-- Tagline -->
      <div>
        <label for="tagline" class="block text-sm font-medium mb-2">Tagline</label>
        <input
          type="text"
          id="tagline"
          name="tagline"
          placeholder="e.g. Drive the future today"
          class="py-2.5 sm:py-3 px-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none">
      </div>

      <!-- Select -->
      <div>
        <label for="hs-multiple-with-option-template" class="block text-sm font-medium mb-2">Vehicle Category</label>
        <select id="hs-multiple-with-option-template" name="categories[]" multiple data-hs-select='{
          "placeholder": "Select multiple options...",
          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex text-nowrap w-full cursor-pointer bg-layer border border-layer-line text-layer-foreground rounded-lg text-start text-sm hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus",
          "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-select border border-select-line rounded-lg shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-scrollbar-track [&::-webkit-scrollbar-thumb]:bg-scrollbar-thumb",
          "optionClasses": "py-2 px-4 w-full text-sm text-select-item-foreground cursor-pointer hover:bg-select-item-hover rounded-lg focus:outline-hidden focus:bg-select-item-focus",
          "optionTemplate": "<div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div><div class=\"hs-selected:font-semibold text-sm text-foreground\" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-primary\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-muted-foreground-1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
              }' class="hidden">
          <?php foreach ($category as $row): ?>
            <option value="<?= $row->cat_no ?>"><?= $row->cat_title ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <!-- End Select -->

    </fieldset>

    <!-- Actions -->
    <div class="flex justify-end pt-4">
      <button
        type="submit"
        :disabled="loading"
        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden focus:bg-primary-hover disabled:opacity-50 disabled:pointer-events-none">
        <span x-show="loading" class="animate-spin inline-block size-4 border-3 border-current border-t-transparent rounded-[999px]" role="status" aria-label="loading"></span>
        <span x-text="loading ? 'Loading...' : 'Add Vehicle'"></span>
      </button>
    </div>
  </form>
</div>

<?= $this->endSection() ?>