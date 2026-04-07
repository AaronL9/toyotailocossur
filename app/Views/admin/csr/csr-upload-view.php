<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>
<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div class="w-full max-w-xl">

    <!-- Page heading -->
    <div class="flex gap-3 mb-6">
        <a href="/admin/csr"
            class="size-8 inline-flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <div>
            <h1 class="text-base font-semibold text-gray-900 leading-none">Upload Cover Photo</h1>
            <p class="text-xs text-gray-400 mt-0.5">
                CSR #<?= esc($csr->csr_no) ?> &mdash; <?= esc($csr->csr_title) ?>
            </p>
        </div>
    </div>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flex items-center gap-2.5 px-4 py-3 mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center gap-2.5 px-4 py-3 mb-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif ?>

    <!-- Upload card -->
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        <form action="/admin/csr/upload/<?= esc($csr->csr_no) ?>/" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Current image (if exists) -->
            <?php if (!empty($csr->csr_image)): ?>
                <div class="relative h-56 bg-gray-100 overflow-hidden">
                    <img src="/img/csr/<?= esc($csr->csr_image) ?>"
                        alt="Current cover photo"
                        class="w-full h-full object-cover">
                    <span class="absolute top-2 start-2 text-[11px] font-medium px-2 py-1 rounded-md bg-black/50 text-white">
                        Current photo
                    </span>
                </div>
            <?php endif ?>

            <!-- File picker -->
            <div class="p-6 <?= !empty($csr->csr_image) ? 'border-t border-gray-100' : '' ?>">
                <label for="csr_image"
                    class="flex flex-col items-center justify-center gap-3 w-full h-48 border-2 border-dashed rounded-xl cursor-pointer transition-colors
            <?= session('errors.csr_image') ? 'border-red-300 bg-red-50' : 'border-gray-200 hover:border-primary-400 hover:bg-primary-50/30' ?>">

                    <div class="flex flex-col items-center gap-3 px-6 text-center pointer-events-none select-none">
                        <div class="size-14 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">
                                <?= !empty($csr->csr_image) ? 'Click to replace photo' : 'Click to upload photo' ?>
                            </p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP &mdash; max 2 MB</p>
                        </div>
                    </div>

                    <input
                        type="file"
                        id="csr_image"
                        name="csr_image"
                        accept="image/png,image/jpeg,image/webp"
                        class="sr-only">
                </label>

                <!-- Validation error -->
                <?php if (session('errors.csr_image')): ?>
                    <div class="flex items-center gap-2 mt-2">
                        <svg class="size-3.5 text-red-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <p class="text-xs text-red-600"><?= esc(session('errors.csr_image')) ?></p>
                    </div>
                <?php endif ?>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50">
                <a href="/admin/csr"
                    class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-600 bg-white hover:bg-gray-50 transition-colors">
                    Cancel
                </a>

                <button type="submit"
                    class="py-2 px-5 inline-flex items-center gap-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden transition-colors">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    Upload Photo
                </button>
            </div>

        </form>
    </div>

</div>
<?= $this->endSection() ?>