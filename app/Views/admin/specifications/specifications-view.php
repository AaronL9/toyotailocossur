<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div x-data="SpecificationsData('<?= csrf_hash() ?>')" class="w-full mx-auto">
  <div class="max-w-2xl px-2">

    <!-- Page Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">
        Specifications
      </h1>
      <p class="text-sm text-gray-500 mt-1">Manage your specification list below.</p>
    </div>

    <!-- Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

      <!-- Input + Add Button -->
      <div class="flex gap-x-3 mb-6">
        <div class="flex-1">
          <label for="spec-input" class="block text-sm  font-medium text-gray-700 mb-1">Specification Name</label>
          <input
            x-model="specification"
            x-ref="specInput"
            type="text"
            id="spec-input"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
            placeholder="Enter specification name..." />
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

      <!-- List -->
      <ul id="spec-list" class="flex flex-col gap-y-2">
        <!-- Empty State -->
        <!-- <li id="empty-state" class="text-center py-8 text-gray-400 text-sm">
          <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
          No specifications added yet.
        </li> -->
        <template x-for="row in data" :key="row.spec_no">
          <li class="flex items-center justify-between px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg group hover:border-gray-300 hover:bg-gray-100 transition-colors duration-150">
            <div class="flex items-center gap-x-3">
              <span class="flex-shrink-0 w-2 h-2 rounded-full bg-primary-950"></span>
              <span x-text="row.spec_title" class="text-sm font-medium text-gray-700"></span>
            </div>
            <div class="flex items-center gap-x-1">
              <button type="button" class="p-1.5 inline-flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-150">
                <i class="fa-solid fa-pen text-xs"></i>
              </button>
              <button type="button" class="p-1.5 inline-flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors duration-150">
                <i class="fa-solid fa-trash text-xs"></i>
              </button>
            </div>
          </li>
        </template>
      </ul>

    </div>
  </div>

  <!-- Edit Modal Backdrop -->
  <div id="edit-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm mx-4">
      <h3 class="text-lg font-semibold text-gray-800 mb-4">
        <i class="fa-solid fa-pen-to-square text-blue-500 mr-2"></i>Edit Specification
      </h3>
      <input
        type="text"
        id="edit-input"
        class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 focus:outline-none mb-4"
        placeholder="Edit specification name..." />
      <div class="flex justify-end gap-x-2">
        <button
          onclick="closeModal()"
          type="button"
          class="py-2 px-4 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50">
          <i class="fa-solid fa-xmark"></i> Cancel
        </button>
        <button
          onclick="saveEdit()"
          type="button"
          class="py-2 px-4 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
          <i class="fa-solid fa-floppy-disk"></i> Save
        </button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>