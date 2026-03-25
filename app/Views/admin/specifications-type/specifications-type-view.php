<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div x-data="SpecificationsType('<?= csrf_hash() ?>')" class="w-full mx-auto">
  <div class="max-w-2xl px-2">

    <!-- Page Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">
        Specifications Type
      </h1>
      <p class="text-sm text-gray-500 mt-1">Manage your specification type list below.</p>
    </div>

    <!-- Search Bar (outside the card) -->
    <div class="mb-4">
      <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
        </div>
        <input
          x-model="search"
          type="text"
          class="py-2.5 pl-9 pr-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none bg-white"
          placeholder="Search specifications..." />
      </div>
    </div>

    <!-- Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

      <!-- Input + Add Button -->
      <div class="flex gap-x-3 mb-6">
        <div class="flex-1">
          <label for="spec-input" class="block text-sm  font-medium text-gray-700 mb-1">Specification Type Name</label>
          <input
            x-model="specType"
            x-ref="specTypeInput"
            type="text"
            id="spec-type-input"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
            placeholder="Enter specification type name..." />
        </div>
        <div class="flex mt-auto">
          <button
            @click="add()"
            type="button"
            class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 text-white hover:bg-primary-800 hover:cursor-pointer">
            <i class="fa-solid fa-plus"></i>
            Add
          </button>
        </div>
      </div>

      <!-- Divider -->
      <hr class="border-t border-gray-100 mb-4" />

      <!-- List Header -->
      <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-3">Specification List</h2>

      <!-- Scrollable List -->
      <ul id="spec-list" class="flex flex-col gap-y-2 max-h-72 overflow-y-auto pr-1">
        <!-- Empty State -->
        <!-- <li id="empty-state" class="text-center py-8 text-gray-400 text-sm">
          <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
          No specifications added yet.
        </li> -->
        <template x-for="row in filteredData" :key="row.spec_no">
          <li class="flex items-center justify-between px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg group hover:border-gray-300 hover:bg-gray-100 transition-colors duration-150">
            <div class="flex items-center gap-x-3">
              <span class="flex-shrink-0 w-2 h-2 rounded-full bg-primary-950"></span>
              <span x-text="row.spec_title" class="text-sm font-medium text-gray-700"></span>
            </div>
            <div class="flex items-center gap-x-1">
              <button @click="edit(row.spec_title, row.spec_no)" type="button" class="p-1.5 inline-flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-150">
                <i class="fa-solid fa-pen text-xs"></i>
              </button>
              <button @click="deleteRow(row.spec_no)" type="button" class="p-1.5 inline-flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors duration-150">
                <i class="fa-solid fa-trash text-xs"></i>
              </button>
            </div>
          </li>
        </template>

        <!-- No results state -->
        <template x-if="filteredData.length === 0">
          <li class="text-center py-8 text-gray-400 text-sm">
            <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
            <span x-text="search ? 'No results found for &quot;' + search + '&quot;.' : 'No specifications added yet.'"></span>
          </li>
        </template>
      </ul>
    </div>
  </div>

  <template id="swal-spec-modal">
    <swal-html>
      <h3 class="text-base font-semibold text-left text-gray-800">
        <i class="fa-solid fa-pen-to-square text-primary-900 mr-2"></i>Edit Specification
      </h3>

      <!-- Divider -->
      <hr class="border-t border-gray-100 my-4" />

      <!-- Input -->
      <div class="mb-4">
        <label class="block text-sm text-left font-medium text-gray-700 mb-1">Specification Name</label>
        <input
          x-model="$store.specType.editInput"
          type="text"
          id="edit-input"
          value="Water Resistance"
          class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
          placeholder="Edit specification name..." />
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
</div>
<?= $this->endSection() ?>