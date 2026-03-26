<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div class="w-full max-w-3xl px-2">

  <nav class="mb-5" aria-label="Breadcrumb">
    <ol class="flex items-center gap-1.5 text-sm text-gray-500">
      <li><a href="/admin/vehicles" class="hover:text-gray-800 transition-colors">Vehicles</a></li>
      <li>
        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="m9 18 6-6-6-6" />
        </svg>
      </li>
      <li>
        <a href="/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>" class="hover:text-gray-800 transition-colors"><?= $cc->vehicle_title ?></a>
      </li>
      <li>
        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="m9 18 6-6-6-6" />
        </svg>
      </li>
      <li class="font-medium text-gray-800">Add photo</li>
    </ol>
  </nav>

  <!-- Page Header -->
  <div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Variant Photo</h1>
    <p class="text-sm text-gray-500 mt-1">Upload and manage photos for this variant.</p>
  </div>

  <!-- ── Variant Info Banner ─────────────────────────────────────── -->
  <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 mb-6">
    <i class="fa-solid fa-hexagon-nodes text-gray-400"></i>
    <div class="text-sm">
      <span class="font-medium text-gray-800"><?= esc($cc->vehicle_title) ?></span>
      <?php if (!empty($cc->variant_model)): ?>
        <span class="text-gray-400 ml-2">&mdash; <?= esc($cc->variant_model) ?></span>
      <?php endif; ?>
    </div>
  </div>

  <!-- ── Upload Card ─────────────────────────────────────────────── -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">

    <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-4">Upload New Photo</h2>

    <form
      action="/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>/variant/photo/<?= $cc->variant_no ?>"
      method="post"
      enctype="multipart/form-data"
      class="flex flex-col gap-5"
      x-data="photoUpload()">

      <?= csrf_field() ?>

      <!-- File Drop Zone -->
      <div
        @dragover.prevent="dragOver = true"
        @dragleave.prevent="dragOver = false"
        @drop.prevent="onDrop($event)"
        :class="dragOver ? 'border-primary-500 bg-primary-50' : (previewUrl ? 'border-gray-300 bg-white' : 'border-gray-200 bg-gray-50')"
        class="relative flex flex-col items-center justify-center gap-3 border-2 border-dashed rounded-xl px-6 py-8 transition-colors duration-150 cursor-pointer"
        @click="$refs.fileInput.click()">

        <input
          x-ref="fileInput"
          type="file"
          name="userfile"
          id="userfile"
          accept=".jpg,.jpeg,.png,.webp"
          class="hidden"
          @change="onFileChange($event)" />

        <!-- Placeholder -->
        <div x-show="!previewUrl" class="flex flex-col items-center gap-2 pointer-events-none">
          <div class="w-12 h-12 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
              <circle cx="9" cy="9" r="2" />
              <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
            </svg>
          </div>
          <p class="text-sm font-medium text-gray-600">Click or drag &amp; drop to upload</p>
          <p class="text-xs text-gray-400">JPG, PNG, WEBP &mdash; max 2MB</p>
        </div>

        <!-- Preview -->
        <div x-show="previewUrl" class="flex flex-col items-center gap-3 pointer-events-none">
          <div class="w-48 h-32 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
            <img :src="previewUrl" alt="Preview" class="w-full h-full object-cover object-top" />
          </div>
          <p class="text-xs text-gray-500" x-text="fileName"></p>
          <p class="text-xs text-green-600 font-medium">
            <i class="fa-solid fa-circle-check mr-1"></i>Ready to upload
          </p>
        </div>
      </div>

      <!-- Change / Clear links -->
      <div x-show="previewUrl" class="flex items-center gap-x-2 -mt-2">
        <button
          type="button"
          @click.stop="$refs.fileInput.click()"
          class="text-xs text-primary-700 hover:underline">
          <i class="fa-solid fa-arrow-rotate-left mr-1"></i>Change file
        </button>
        <span class="text-gray-300">|</span>
        <button
          type="button"
          @click.stop="clearFile()"
          class="text-xs text-red-500 hover:underline">
          <i class="fa-solid fa-xmark mr-1"></i>Clear
        </button>
      </div>

      <!-- Color Picker Row -->
      <div class="flex flex-wrap gap-3">

        <!-- Color Name -->
        <div class="flex-1 min-w-[160px]">
          <label for="photo-color-name" class="block text-sm font-medium text-gray-700 mb-1">
            Color Name <span class="text-gray-400 font-normal">(optional)</span>
          </label>
          <input
            x-model="colorTitle"
            type="text"
            name="color_title"
            id="photo-color-name"
            value="<?= old('color_title') ?>"
            class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
            placeholder="e.g. Midnight Black" />
        </div>

        <!-- Hex Picker -->
        <div class="w-44">
          <label for="photo-color-hex" class="block text-sm font-medium text-gray-700 mb-1">Hex Color</label>
          <div class="flex items-center gap-x-2">
            <input
              x-model="colorHex"
              @input="syncPicker()"
              type="text"
              name="color_hex_value"
              id="photo-color-hex"
              maxlength="7"
              value="<?= old('color_hex_value', '#000000') ?>"
              class="py-2.5 px-4 block w-full border border-gray-200 rounded-lg text-sm font-mono focus:border-primary-500 focus:ring-primary-500 focus:outline-none"
              placeholder="#000000" />
            <input
              x-ref="colorPicker"
              @input="colorHex = $event.target.value"
              type="color"
              class="w-9 h-9 rounded-md border border-gray-200 cursor-pointer p-0.5 flex-shrink-0"
              :value="colorHex" />
          </div>
        </div>

        <!-- Live preview pill -->
        <div class="flex items-end pb-0.5">
          <div
            class="flex items-center gap-x-2 px-3 py-2 rounded-lg border border-gray-200 transition-all duration-150"
            :style="isValidHex(colorHex) ? `border-left: 4px solid ${colorHex}` : ''">
            <span
              class="w-4 h-4 rounded-full border border-gray-300 flex-shrink-0 transition-colors duration-150"
              :style="`background-color: ${isValidHex(colorHex) ? colorHex : '#e5e7eb'}`">
            </span>
            <span x-text="colorTitle || 'No color'" class="text-xs text-gray-500 max-w-[100px] truncate"></span>
          </div>
        </div>

      </div>

      <!-- Flash: error -->
      <?php if (session()->getFlashdata('userfile_error')): ?>
        <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert">
          <div class="flex gap-x-3">
            <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <path d="m15 9-6 6" />
              <path d="m9 9 6 6" />
            </svg>
            <p class="font-medium"><?= session()->getFlashdata('userfile_error') ?></p>
          </div>
        </div>
      <?php endif; ?>

      <!-- Flash: success -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-50 border border-green-200 text-sm text-green-800 rounded-lg p-4" role="alert">
          <div class="flex gap-x-3">
            <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
          </div>
        </div>
      <?php endif; ?>

      <!-- Submit Button -->
      <div class="flex items-center justify-end pt-2 border-t border-gray-100">
        <button
          type="submit"
          :disabled="!previewUrl"
          :class="!previewUrl ? 'opacity-50 pointer-events-none' : 'hover:bg-primary-800'"
          class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 text-white transition-colors duration-150">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
            <polyline points="17 8 12 3 7 8" />
            <line x1="12" x2="12" y1="3" y2="15" />
          </svg>
          Upload Photo
        </button>
      </div>
    </form>
  </div>

  <!-- ── Photo Gallery (server-rendered) ────────────────────────── -->
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

    <h2 class="text-xs font-semibold uppercase text-gray-400 tracking-wider mb-4">Uploaded Photos</h2>

    <?php if (empty($photos)): ?>
      <div class="text-center py-10 text-gray-400 text-sm">
        <i class="fa-regular fa-images text-3xl mb-2 block"></i>
        No photos uploaded yet.
      </div>
    <?php else: ?>
      <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <?php foreach ($photos as $photo): ?>
          <div class="group relative rounded-xl overflow-hidden border border-gray-200 bg-gray-50 shadow-sm hover:shadow-md transition-shadow duration-150">

            <!-- Image -->
            <div class="w-full h-32 overflow-hidden">
              <img
                src="<?= site_url('img/variants/' . esc($photo->variant_filename)) ?>"
                alt="<?= esc($photo->color_title ?? 'Variant photo') ?>"
                class="w-full h-full object-cover object-top transition-transform duration-200 group-hover:scale-105" />
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between px-3 py-2 border-t border-gray-100 bg-white">
              <div class="flex items-center gap-x-2 overflow-hidden">
                <?php if (!empty($photo->color_hex_value)): ?>
                  <span
                    class="flex-shrink-0 w-4 h-4 rounded-full border border-gray-300"
                    style="background-color: <?= esc($photo->color_hex_value) ?>">
                  </span>
                <?php else: ?>
                  <span class="flex-shrink-0 w-4 h-4 rounded-full border border-gray-200 bg-gray-100"></span>
                <?php endif; ?>
                <span class="text-xs text-gray-600 truncate max-w-[90px]">
                  <?= esc($photo->color_title ?? 'No color') ?>
                </span>
              </div>

              <!-- Delete form (standard POST) -->
              <form
                action="/admin/vehicles/<?= url_title($cc->vehicle_title, '-', true) ?>/variant/photo/<?= $photo->photo_no ?>"

                method="post"
                onsubmit="return confirm('Delete this photo? This cannot be undone.')">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <button
                  type="submit"
                  class="p-1 inline-flex items-center justify-center text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors duration-150">
                  <i class="fa-solid fa-trash text-xs"></i>
                </button>
              </form>
            </div>

            <!-- Hover overlay -->
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-150 pointer-events-none rounded-xl"></div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>

</div>

<script>
  function photoUpload() {
    return {
      previewUrl: null,
      fileName: '',
      dragOver: false,
      colorTitle: '<?= old('color_title') ?>',
      colorHex: '<?= old('color_hex_value', '#000000') ?>',

      onFileChange(event) {
        const file = event.target.files[0];
        if (file) this.loadPreview(file);
      },

      onDrop(event) {
        this.dragOver = false;
        const file = event.dataTransfer.files[0];
        if (file) {
          // Transfer dropped file into the real <input type="file"> so it submits with the form
          const dt = new DataTransfer();
          dt.items.add(file);
          this.$refs.fileInput.files = dt.files;
          this.loadPreview(file);
        }
      },

      loadPreview(file) {
        this.fileName = file.name;
        const reader = new FileReader();
        reader.onload = (e) => {
          this.previewUrl = e.target.result;
        };
        reader.readAsDataURL(file);
      },

      clearFile() {
        this.previewUrl = null;
        this.fileName = '';
        this.$refs.fileInput.value = '';
      },

      syncPicker() {
        if (this.isValidHex(this.colorHex)) {
          this.$refs.colorPicker.value = this.colorHex;
        }
      },

      isValidHex(val) {
        return /^#[0-9A-Fa-f]{6}$/.test(val);
      },
    };
  }
</script>

<?= $this->endSection() ?>