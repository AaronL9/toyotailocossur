<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div class="w-full max-w-5xl" x-data="bannerManager()">

    <!-- Page heading -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex gap-3">
            <a href="/admin"
                class="size-8 inline-flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </a>
            <div>
                <h1 class="text-base font-semibold text-gray-900 leading-none">Banners</h1>
                <p class="text-xs text-gray-400 mt-0.5">Manage homepage banner slides</p>
            </div>
        </div>

        <!-- Add Banner button -->
        <button type="button" @click="openAddModal()"
            class="py-2 px-4 inline-flex items-center gap-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-800 focus:outline-hidden transition-colors">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Add Banner
        </button>
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

    <!-- Banner table -->
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        <?php if (empty($banners)): ?>
            <!-- Empty state -->
            <div class="flex flex-col items-center justify-center py-16 text-center px-6">
                <div class="size-14 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mb-3">
                    <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="m3 9 4-4 4 4 4-4 4 4" />
                        <path d="M3 15h18" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-700">No banners yet</p>
                <p class="text-xs text-gray-400 mt-1">Click <span class="font-medium">Add Banner</span> to create your first slide.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide w-10">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide w-28">Photo</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Heading</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Subheading</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wide w-24">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wide w-20">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($banners as $banner): ?>
                            <tr class="hover:bg-gray-50/60 transition-colors">

                                <!-- No -->
                                <td class="px-4 py-3 text-gray-400 text-xs font-mono">
                                    <?= esc($banner->banner_no) ?>
                                </td>

                                <!-- Photo -->
                                <td class="px-4 py-3">
                                    <?php if (!empty($banner->banner_photo)): ?>
                                        <div class="w-24 h-14 rounded-lg overflow-hidden border border-gray-200 bg-gray-100">
                                            <img src="/img/banners/<?= esc($banner->banner_photo) ?>"
                                                alt="<?= esc($banner->banner_title) ?>"
                                                class="w-full h-full object-cover">
                                        </div>
                                    <?php else: ?>
                                        <div class="w-24 h-14 rounded-lg border border-dashed border-gray-200 bg-gray-50 flex items-center justify-center text-gray-300">
                                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <path d="m21 15-5-5L5 21" />
                                            </svg>
                                        </div>
                                    <?php endif ?>
                                </td>

                                <!-- Title -->
                                <td class="px-4 py-3">
                                    <span class="font-medium text-gray-800 line-clamp-1"><?= esc($banner->banner_title) ?></span>
                                </td>

                                <!-- Heading -->
                                <td class="px-4 py-3 text-gray-600 line-clamp-1 max-w-xs">
                                    <?= esc($banner->banner_heading) ?>
                                </td>

                                <!-- Subheading -->
                                <td class="px-4 py-3 text-gray-400 text-xs line-clamp-2 max-w-xs">
                                    <?= esc($banner->banner_subheading) ?>
                                </td>

                                <!-- Status toggle -->
                                <td class="px-4 py-3 text-center">
                                    <form action="/admin/banners/toggle/<?= esc($banner->banner_no) ?>" method="post" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-md text-xs font-medium transition-colors
                                                <?= $banner->banner_inactive
                                                    ? 'bg-gray-100 text-gray-500 hover:bg-gray-200'
                                                    : 'bg-green-50 text-green-700 hover:bg-green-100' ?>">
                                            <span class="size-1.5 rounded-full <?= $banner->banner_inactive ? 'bg-gray-400' : 'bg-green-500' ?>"></span>
                                            <?= $banner->banner_inactive ? 'Inactive' : 'Active' ?>
                                        </button>
                                    </form>
                                </td>

                                <!-- Delete -->
                                <td class="px-4 py-3 text-right">
                                    <button type="button"
                                        @click="confirmDelete(<?= esc($banner->banner_no) ?>, '<?= esc($banner->banner_title, 'js') ?>')"
                                        class="size-8 inline-flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:border-red-200 hover:text-red-500 hover:bg-red-50 transition-colors">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                            <path d="M10 11v6M14 11v6" />
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                        </svg>
                                    </button>
                                </td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </div>


    <!-- ============================================================ -->
    <!-- ADD BANNER MODAL                                             -->
    <!-- ============================================================ -->
    <div x-show="showAddModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
        @click.self="closeAddModal()"
        style="display: none;">

        <div x-show="showAddModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-lg bg-white rounded-xl border border-gray-200 shadow-xl overflow-hidden">

            <!-- Modal header -->
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-sm font-semibold text-gray-900 leading-none">Add Banner</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Fill in the details for the new banner slide</p>
                </div>
                <button type="button" @click="closeAddModal()"
                    class="size-7 inline-flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-colors">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal form -->
            <form action="/admin/banner/store" method="post" enctype="multipart/form-data"
                x-data="bannerPhotoUpload()" @submit.prevent="$el.submit()">
                <?= csrf_field() ?>

                <div class="px-5 py-4 space-y-4 max-h-[70vh] overflow-y-auto">

                    <!-- Banner Title -->
                    <div>
                        <label for="banner_title" class="block text-xs font-medium text-gray-700 mb-1.5">
                            Banner Title <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="banner_title" name="banner_title"
                            value="<?= old('banner_title') ?>"
                            placeholder="e.g. Summer Campaign 2025"
                            class="py-2 px-3 block w-full text-sm rounded-lg border <?= session('errors.banner_title') ? 'border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-100' ?> focus:outline-none focus:ring-2 transition-colors">
                        <?php if (session('errors.banner_title')): ?>
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="size-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                <?= esc(session('errors.banner_title')) ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <!-- Banner Heading -->
                    <div>
                        <label for="banner_heading" class="block text-xs font-medium text-gray-700 mb-1.5">
                            Heading <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="banner_heading" name="banner_heading"
                            value="<?= old('banner_heading') ?>"
                            placeholder="Large text displayed on the banner"
                            class="py-2 px-3 block w-full text-sm rounded-lg border <?= session('errors.banner_heading') ? 'border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-100' ?> focus:outline-none focus:ring-2 transition-colors">
                        <?php if (session('errors.banner_heading')): ?>
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="size-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                <?= esc(session('errors.banner_heading')) ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <!-- Banner Subheading -->
                    <div>
                        <label for="banner_subheading" class="block text-xs font-medium text-gray-700 mb-1.5">
                            Subheading
                        </label>
                        <textarea id="banner_subheading" name="banner_subheading"
                            rows="2"
                            placeholder="Supporting text below the heading"
                            class="py-2 px-3 block w-full text-sm rounded-lg border <?= session('errors.banner_subheading') ? 'border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-200' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-100' ?> focus:outline-none focus:ring-2 transition-colors resize-none"><?= old('banner_subheading') ?></textarea>
                        <?php if (session('errors.banner_subheading')): ?>
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <svg class="size-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                <?= esc(session('errors.banner_subheading')) ?>
                            </p>
                        <?php endif ?>
                    </div>

                    <!-- Banner Photo drop zone -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">
                            Banner Photo <span class="text-red-400">*</span>
                        </label>

                        <div
                            @dragover.prevent="dragOver = true"
                            @dragleave.prevent="dragOver = false"
                            @drop.prevent="onDrop($event)"
                            :class="dragOver
                                ? 'border-primary-500 bg-primary-50'
                                : (previewUrl ? 'border-gray-300 bg-white' : '<?= session('errors.banner_photo') ? 'border-red-300 bg-red-50' : 'border-gray-200 hover:border-primary-400 hover:bg-primary-50/30' ?>')"
                            class="flex flex-col items-center justify-center gap-3 w-full h-40 border-2 border-dashed rounded-xl cursor-pointer transition-colors"
                            @click="$refs.bannerFileInput.click()">

                            <input
                                x-ref="bannerFileInput"
                                type="file"
                                id="banner_photo"
                                name="userfile"
                                accept="image/png,image/jpeg,image/webp"
                                class="sr-only"
                                @change="onFileChange($event)" />

                            <!-- Placeholder -->
                            <div x-show="!previewUrl" class="flex flex-col items-center gap-2 px-6 text-center pointer-events-none select-none">
                                <div class="size-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="17 8 12 3 7 8" />
                                        <line x1="12" y1="3" x2="12" y2="15" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Click or drag to upload photo</p>
                                    <p class="text-xs text-gray-400 mt-0.5">PNG, JPG, WEBP &mdash; max 2 MB</p>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div x-show="previewUrl" class="flex flex-col items-center gap-2 pointer-events-none">
                                <div class="w-48 h-24 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                    <img :src="previewUrl" alt="Preview" class="w-full h-full object-cover" />
                                </div>
                                <p class="text-xs text-gray-500" x-text="fileName"></p>
                                <p class="text-xs text-green-600 font-medium flex items-center gap-1">
                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                        <polyline points="22 4 12 14.01 9 11.01" />
                                    </svg>
                                    Ready to upload
                                </p>
                            </div>
                        </div>

                        <!-- Change / Clear -->
                        <div x-show="previewUrl" class="flex items-center gap-x-2 mt-1.5">
                            <button type="button" @click.stop="$refs.bannerFileInput.click()"
                                class="text-xs text-primary-700 hover:underline">
                                &#8635; Change file
                            </button>
                            <span class="text-gray-300">|</span>
                            <button type="button" @click.stop="clearFile()"
                                class="text-xs text-red-500 hover:underline">
                                &times; Clear
                            </button>
                        </div>

                        <?php if (session('errors.banner_photo')): ?>
                            <div class="flex items-center gap-2 mt-1.5">
                                <svg class="size-3.5 text-red-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                <p class="text-xs text-red-600"><?= esc(session('errors.banner_photo')) ?></p>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- Inactive toggle -->
                    <div class="flex items-center justify-between py-2.5 px-3.5 rounded-lg bg-gray-50 border border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-700 leading-none">Set as Inactive</p>
                            <p class="text-xs text-gray-400 mt-0.5">Banner won't be shown on the website</p>
                        </div>
                        <label class="relative inline-block w-9 h-5 cursor-pointer">
                            <input type="checkbox" name="banner_inactive" value="1"
                                <?= old('banner_inactive') ? 'checked' : '' ?>
                                class="sr-only peer">
                            <span class="block w-full h-full rounded-full bg-gray-200 peer-checked:bg-primary-950 transition-colors"></span>
                            <span class="absolute top-0.5 start-0.5 size-4 rounded-full bg-white shadow transition-transform peer-checked:translate-x-4"></span>
                        </label>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="flex items-center justify-between gap-3 px-5 py-4 border-t border-gray-100 bg-gray-50">
                    <button type="button" @click="closeAddModal()"
                        class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-600 bg-white hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        :disabled="!previewUrl"
                        :class="!previewUrl ? 'opacity-50 pointer-events-none' : 'hover:bg-primary-800'"
                        class="py-2 px-5 inline-flex items-center gap-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground focus:outline-hidden transition-colors">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Save Banner
                    </button>
                </div>

            </form>
        </div>
    </div>


    <!-- ============================================================ -->
    <!-- DELETE CONFIRMATION MODAL                                    -->
    <!-- ============================================================ -->
    <div x-show="showDeleteModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm"
        @click.self="showDeleteModal = false"
        style="display: none;">

        <div x-show="showDeleteModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-sm bg-white rounded-xl border border-gray-200 shadow-xl overflow-hidden">

            <div class="p-5">
                <!-- Icon -->
                <div class="size-10 rounded-full bg-red-50 border border-red-100 flex items-center justify-center text-red-500 mb-3">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                        <path d="M10 11v6M14 11v6" />
                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Delete Banner</h3>
                <p class="text-xs text-gray-500 mt-1">
                    Are you sure you want to delete
                    <span class="font-medium text-gray-800" x-text="'&quot;' + deleteTitle + '&quot;'"></span>?
                    This action cannot be undone.
                </p>
            </div>

            <div class="flex items-center gap-2 px-5 py-4 border-t border-gray-100 bg-gray-50">
                <button type="button" @click="showDeleteModal = false"
                    class="flex-1 py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-600 bg-white hover:bg-gray-50 transition-colors">
                    Cancel
                </button>

                <form :action="'/admin/banner/' + deleteNo" method="post" class="flex-1">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit"
                        class="w-full py-2 px-4 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors">
                        Yes, Delete
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>

<script>
    function bannerManager() {
        return {
            showAddModal: false,
            showDeleteModal: false,
            deleteNo: null,
            deleteTitle: '',

            openAddModal() {
                this.showAddModal = true;
                document.body.classList.add('overflow-hidden');
            },
            closeAddModal() {
                this.showAddModal = false;
                document.body.classList.remove('overflow-hidden');
            },
            confirmDelete(no, title) {
                this.deleteNo = no;
                this.deleteTitle = title;
                this.showDeleteModal = true;
                document.body.classList.add('overflow-hidden');
            },
        };
    }

    function bannerPhotoUpload() {
        return {
            previewUrl: null,
            fileName: '',
            dragOver: false,

            onFileChange(event) {
                const file = event.target.files[0];
                if (file) this.loadPreview(file);
            },
            onDrop(event) {
                this.dragOver = false;
                const file = event.dataTransfer.files[0];
                if (file) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    this.$refs.bannerFileInput.files = dt.files;
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
                this.$refs.bannerFileInput.value = '';
            },
        };
    }
</script>

<?= $this->endSection() ?>