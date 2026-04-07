<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>
<?= $this->endSection() ?>

<?= $this->section("page") ?>
<style>
    .ProseMirror:focus {
        outline: none;
    }

    .tiptap ul p,
    .tiptap ol p {
        display: inline;
    }

    .tiptap p.is-editor-empty:first-child::before {
        content: attr(data-placeholder);
        float: left;
        height: 0;
        pointer-events: none;
    }
</style>

<div class="w-full max-w-3xl" x-data="csrForm('<?= csrf_hash() ?>', '<?= $csr->csr_no ?>')">
    <!-- Page heading -->
    <div class="flex gap-3 mb-6">
        <a href="/admin/csr"
            class="size-8 inline-flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <div>
            <h1 class="text-base font-semibold text-gray-900 leading-none">Edit CSR Activity</h1>
            <p class="text-xs text-gray-400 mt-0.5">Fill in the details below and publish when ready.</p>
        </div>
    </div>

    <form @submit.prevent="submit" enctype="multipart/form-data" novalidate>
        <div class="flex flex-col gap-5">

            <!-- Title -->
            <div class="flex flex-col gap-1.5">
                <label for="csr_title" class="text-sm font-medium text-gray-700">
                    Title <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="csr_title"
                    name="csr_title"
                    x-model="form.csr_title"
                    maxlength="150"
                    placeholder="e.g. Community Tree Planting Drive in Ilocos Norte"
                    class="py-2 px-3 block w-full bg-layer border border-layer-line rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
                    :class="errors.csr_title ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''">
                <p x-show="errors.csr_title" x-text="errors.csr_title" class="text-xs text-red-500 mt-0.5"></p>
            </div>

            <!-- Content — Tiptap WYSIWYG -->
            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-gray-700">
                    Content <span class="text-red-500">*</span>
                </label>

                <div class="bg-layer border border-layer-line rounded-xl overflow-hidden"
                    :class="errors.csr_content ? 'border-red-400' : ''">
                    <div id="csr-editor">

                        <!-- Toolbar -->
                        <div class="sticky top-0 bg-layer flex flex-wrap align-middle gap-x-0.5 border-b border-layer-line p-2">
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-bold title="Bold">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 12a4 4 0 0 0 0-8H6v8" />
                                    <path d="M15 20a4 4 0 0 0 0-8H6v8Z" />
                                </svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-italic title="Italic">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="19" x2="10" y1="4" y2="4" />
                                    <line x1="14" x2="5" y1="20" y2="20" />
                                    <line x1="15" x2="9" y1="4" y2="20" />
                                </svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-underline title="Underline">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 4v6a6 6 0 0 0 12 0V4" />
                                    <line x1="4" x2="20" y1="20" y2="20" />
                                </svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-strike title="Strikethrough">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4H9a3 3 0 0 0-2.83 4" />
                                    <path d="M14 12a4 4 0 0 1 0 8H6" />
                                    <line x1="4" x2="20" y1="12" y2="12" />
                                </svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-link title="Insert link">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                </svg>
                            </button>

                            <div class="w-px h-6 bg-layer-line mx-1 self-center"></div>

                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ol title="Ordered list">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="10" x2="21" y1="6" y2="6" />
                                    <line x1="10" x2="21" y1="12" y2="12" />
                                    <line x1="10" x2="21" y1="18" y2="18" />
                                    <path d="M4 6h1v4" />
                                    <path d="M4 10h2" />
                                    <path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1" />
                                </svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ul title="Bullet list">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="8" x2="21" y1="6" y2="6" />
                                    <line x1="8" x2="21" y1="12" y2="12" />
                                    <line x1="8" x2="21" y1="18" y2="18" />
                                    <line x1="3" x2="3.01" y1="6" y2="6" />
                                    <line x1="3" x2="3.01" y1="12" y2="12" />
                                    <line x1="3" x2="3.01" y1="18" y2="18" />
                                </svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-blockquote title="Blockquote">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 6H3" />
                                    <path d="M21 12H8" />
                                    <path d="M21 18H8" />
                                    <path d="M3 12v6" />
                                </svg>
                            </button>
                            <button class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full text-foreground hover:bg-muted-hover focus:outline-hidden focus:bg-muted-focus disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-code title="Code">
                                <svg class="shrink-0 size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 16 4-4-4-4" />
                                    <path d="m6 8-4 4 4 4" />
                                    <path d="m14.5 4-5 16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Editor area -->
                        <div class="min-h-48 overflow-auto" data-hs-editor-field></div>
                    </div>
                </div>

                <p x-show="errors.csr_content" x-text="errors.csr_content" class="text-xs text-red-500 mt-0.5"></p>
            </div>

            <!-- Date + Image: two columns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <!-- CSR Date -->
                <div class="flex flex-col gap-1.5">
                    <label for="csr_date" class="text-sm font-medium text-gray-700">
                        Activity Date <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="date"
                        id="csr_date"
                        name="csr_date"
                        x-model="form.csr_date"
                        class="py-2 px-3 block w-full bg-layer border border-layer-line rounded-lg sm:text-sm text-foreground focus:border-primary-focus focus:ring-primary-focus"
                        :class="errors.csr_date ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''">
                    <p x-show="errors.csr_date" x-text="errors.csr_date" class="text-xs text-red-500 mt-0.5"></p>
                </div>
            </div>

            <!-- Form actions -->
            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="/admin/csr"
                    class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" :disabled="submitting"
                    class="py-2 px-4 inline-flex items-center gap-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover disabled:opacity-60 disabled:pointer-events-none focus:outline-hidden transition-colors">
                    <template x-if="submitting">
                        <svg class="animate-spin size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                        </svg>
                    </template>
                    <template x-if="!submitting">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                    </template>
                    <span x-text="submitting ? 'Saving…' : 'Save CSR'"></span>
                </button>
            </div>

        </div>
    </form>
</div>
<?= $this->endSection() ?>