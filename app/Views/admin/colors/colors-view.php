<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div x-data="Colors('<?= csrf_hash() ?>')" class="w-full mx-auto">
  <div class="max-w-3xl px-2">

    <!-- Page Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">
        Colors
      </h1>
      <p class="text-sm text-gray-500 mt-1">Manage your color list below.</p>
    </div>

    <!-- Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

      <!-- Input + Add Button -->
      <div class="flex flex-wrap gap-3 mb-6">
        <!-- Color Name -->
        <div class="flex-1 min-w-[180px]">
          <label for="color-title-input" class="block text-sm font-medium text-gray-700 mb-1">Color Name</label>
          <input
            x-model="colorTitle"
            x-ref="colorTitleInput"
            type="text"
            id="color-title-input"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
            placeholder="e.g. Midnight Black" />
        </div>

        <!-- Hex Value -->
        <div class="w-40">
          <label for="color-hex-input" class="block text-sm font-medium text-gray-700 mb-1">Hex Value</label>
          <div class="flex items-center gap-x-2">
            <input
              x-model="colorHex"
              @input="syncPicker()"
              type="text"
              id="color-hex-input"
              class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
              placeholder="#000000"
              maxlength="7" />
            <input
              x-ref="colorPicker"
              @input="syncHex($event)"
              type="color"
              class="w-9 h-9 rounded-md border border-gray-200 cursor-pointer p-0.5 flex-shrink-0"
              value="#000000" />
          </div>
        </div>

        <!-- Add Button -->
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
      <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-3">Color List</h2>

      <!-- List -->
      <ul class="flex flex-col gap-y-2">
        <template x-if="data.length === 0">
          <li class="text-center py-8 text-gray-400 text-sm">
            <i class="fa-regular fa-palette text-3xl mb-2 block"></i>
            No colors added yet.
          </li>
        </template>
        <template x-for="row in data" :key="row.color_no">
          <li class="flex items-center justify-between px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg group hover:border-gray-300 hover:bg-gray-100 transition-colors duration-150">
            <div class="flex items-center gap-x-3">
              <!-- Color swatch -->
              <span
                class="flex-shrink-0 w-6 h-6 rounded-md border border-gray-300 shadow-sm"
                :style="`background-color: ${row.color_hex_value}`">
              </span>
              <div>
                <span x-text="row.color_title" class="text-sm font-medium text-gray-700 block"></span>
                <span x-text="row.color_hex_value" class="text-xs text-gray-400 uppercase font-mono"></span>
              </div>
            </div>
            <div class="flex items-center gap-x-1">
              <button
                @click="edit(row)"
                type="button"
                class="p-1.5 inline-flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-150">
                <i class="fa-solid fa-pen text-xs"></i>
              </button>
              <button
                @click="deleteRow(row.color_no)"
                type="button"
                class="p-1.5 inline-flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors duration-150">
                <i class="fa-solid fa-trash text-xs"></i>
              </button>
            </div>
          </li>
        </template>
      </ul>
    </div>
  </div>

  <!-- Edit Modal Template -->
  <template id="swal-color-modal">
    <swal-html>
      <h3 class="text-base font-semibold text-left text-gray-800">
        <i class="fa-solid fa-pen-to-square text-primary-900 mr-2"></i>Edit Color
      </h3>

      <!-- Divider -->
      <hr class="border-t border-gray-100 my-4" />

      <!-- Color Name Input -->
      <div class="mb-4">
        <label class="block text-sm text-left font-medium text-gray-700 mb-1">Color Name</label>
        <input
          x-model="$store.color.editTitle"
          type="text"
          id="edit-color-title"
          class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
          placeholder="Edit color name..." />
      </div>

      <!-- Hex Value Input -->
      <div class="mb-4">
        <label class="block text-sm text-left font-medium text-gray-700 mb-1">Hex Value</label>
        <div class="flex items-center gap-x-2">
          <input
            x-model="$store.color.editHex"
            @input="document.getElementById('edit-color-picker').value = $store.color.editHex"
            type="text"
            id="edit-color-hex"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
            placeholder="#000000"
            maxlength="7" />
          <input
            id="edit-color-picker"
            @input="$store.color.editHex = $event.target.value"
            type="color"
            class="w-9 h-9 rounded-md border border-gray-200 cursor-pointer p-0.5 flex-shrink-0"
            :value="$store.color.editHex" />
        </div>
      </div>

      <!-- Live Preview -->
      <div class="flex items-center gap-x-3 px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg">
        <span
          id="edit-preview-swatch"
          class="flex-shrink-0 w-8 h-8 rounded-md border border-gray-300 shadow-sm"
          :style="`background-color: ${$store.color.editHex}`">
        </span>
        <div>
          <p class="text-xs text-gray-500">Preview</p>
          <p x-text="$store.color.editTitle || 'Color Name'" class="text-sm font-medium text-gray-700"></p>
          <p x-text="$store.color.editHex" class="text-xs text-gray-400 font-mono uppercase"></p>
        </div>
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