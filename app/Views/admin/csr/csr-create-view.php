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

<div class="w-full max-w-3xl mx-auto" x-data="csrForm('<?= csrf_hash() ?>')">

    <!-- Page heading -->
    <div class="flex items-center gap-3 mb-6">
        <a href="/admin/csr"
            class="size-8 inline-flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <div>
            <h1 class="text-base font-semibold text-gray-900 leading-none">Add CSR Activity</h1>
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
                        type="datetime-local"
                        id="csr_date"
                        name="csr_date"
                        x-model="form.csr_date"
                        class="py-2 px-3 block w-full bg-layer border border-layer-line rounded-lg sm:text-sm text-foreground focus:border-primary-focus focus:ring-primary-focus"
                        :class="errors.csr_date ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''">
                    <p x-show="errors.csr_date" x-text="errors.csr_date" class="text-xs text-red-500 mt-0.5"></p>
                </div>

                <!-- Status -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Status</label>
                    <div class="flex items-center gap-3 h-9">
                        <label class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" class="peer sr-only" x-model="form.csr_active">
                            <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors peer-checked:bg-primary-600"></span>
                            <span class="absolute top-0.5 start-0.5 size-5 bg-white rounded-full shadow-xs transition-transform peer-checked:translate-x-5"></span>
                        </label>
                        <span class="text-sm text-gray-600">
                            <span x-show="form.csr_active" class="text-primary-700 font-medium">Active</span>
                            <span x-show="!form.csr_active" class="text-gray-400">Inactive</span>
                        </span>
                    </div>
                    <p class="text-[11px] text-gray-400">Toggle off to save as draft without publishing.</p>
                </div>
            </div>

            <!-- Cover Image -->
            <div class="flex flex-col gap-1.5">
                <label class="text-sm font-medium text-gray-700">Cover Image</label>

                <!-- Drop zone -->
                <label for="csr_image"
                    class="group relative flex flex-col items-center justify-center gap-2 w-full h-40 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer hover:border-primary-400 hover:bg-primary-50/30 transition-colors overflow-hidden"
                    x-ref="dropzone">

                    <!-- Preview -->
                    <template x-if="imagePreview">
                        <img :src="imagePreview" alt="Preview" class="absolute inset-0 w-full h-full object-cover rounded-xl">
                    </template>

                    <!-- Overlay / placeholder -->
                    <div class="relative z-10 flex flex-col items-center gap-1.5 transition-opacity"
                        :class="imagePreview ? 'opacity-0 group-hover:opacity-100' : 'opacity-100'">
                        <div class="size-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-primary-100 group-hover:text-primary-600 transition-colors">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-medium text-gray-700">
                                <span x-show="!imagePreview">Click to upload or drag & drop</span>
                                <span x-show="imagePreview">Click to change image</span>
                            </p>
                            <p class="text-[11px] text-gray-400 mt-0.5">PNG, JPG, WEBP — max 2MB</p>
                        </div>
                    </div>

                    <input
                        type="file"
                        id="csr_image"
                        name="csr_image"
                        accept="image/png,image/jpeg,image/webp"
                        class="sr-only"
                        @change="previewImage($event)">
                </label>

                <!-- Remove image -->
                <template x-if="imagePreview">
                    <button type="button" @click="removeImage"
                        class="self-start inline-flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 transition-colors">
                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6 18 20H6L5 6m5 0V4h4v2" />
                        </svg>
                        Remove image
                    </button>
                </template>

                <p x-show="errors.csr_image" x-text="errors.csr_image" class="text-xs text-red-500 mt-0.5"></p>
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

<script type="module">
    import {
        Editor
    } from 'https://esm.sh/@tiptap/core';
    import StarterKit from 'https://esm.sh/@tiptap/starter-kit';
    import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder';
    import Paragraph from 'https://esm.sh/@tiptap/extension-paragraph';
    import Bold from 'https://esm.sh/@tiptap/extension-bold';
    import Underline from 'https://esm.sh/@tiptap/extension-underline';
    import Link from 'https://esm.sh/@tiptap/extension-link';
    import BulletList from 'https://esm.sh/@tiptap/extension-bullet-list';
    import OrderedList from 'https://esm.sh/@tiptap/extension-ordered-list';
    import ListItem from 'https://esm.sh/@tiptap/extension-list-item';

    const editor = new Editor({
        element: document.querySelector('#csr-editor [data-hs-editor-field]'),
        editorProps: {
            attributes: {
                class: 'tiptap relative min-h-48 p-3 text-sm text-foreground'
            }
        },
        extensions: [
            StarterKit.configure({
                history: false
            }),
            Placeholder.configure({
                placeholder: 'Describe the CSR activity in detail…',
                emptyNodeClass: 'before:text-muted-foreground-1'
            }),
            Paragraph.configure({
                HTMLAttributes: {
                    class: 'text-sm text-foreground'
                }
            }),
            Bold.configure({
                HTMLAttributes: {
                    class: 'font-bold'
                }
            }),
            Underline,
            Link.configure({
                HTMLAttributes: {
                    class: 'inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-white'
                }
            }),
            BulletList.configure({
                HTMLAttributes: {
                    class: 'list-disc list-inside text-foreground'
                }
            }),
            OrderedList.configure({
                HTMLAttributes: {
                    class: 'list-decimal list-inside text-foreground'
                }
            }),
            ListItem.configure({
                HTMLAttributes: {
                    class: 'marker:text-sm'
                }
            }),
        ]
    });

    // Sync editor content into Alpine's form.csr_content
    editor.on('update', () => {
        const alpineEl = document.querySelector('[x-data]');
        if (alpineEl && alpineEl._x_dataStack) {
            const data = Alpine.$data(alpineEl);
            data.form.csr_content = editor.getHTML();
        }
    });

    // Expose editor globally so Alpine can read it on submit
    window.__csrEditor = editor;

    const actions = [{
            sel: '[data-hs-editor-bold]',
            fn: () => editor.chain().focus().toggleBold().run()
        },
        {
            sel: '[data-hs-editor-italic]',
            fn: () => editor.chain().focus().toggleItalic().run()
        },
        {
            sel: '[data-hs-editor-underline]',
            fn: () => editor.chain().focus().toggleUnderline().run()
        },
        {
            sel: '[data-hs-editor-strike]',
            fn: () => editor.chain().focus().toggleStrike().run()
        },
        {
            sel: '[data-hs-editor-link]',
            fn: () => {
                const url = window.prompt('Enter URL:');
                if (url) editor.chain().focus().extendMarkRange('link').setLink({
                    href: url
                }).run();
            }
        },
        {
            sel: '[data-hs-editor-ol]',
            fn: () => editor.chain().focus().toggleOrderedList().run()
        },
        {
            sel: '[data-hs-editor-ul]',
            fn: () => editor.chain().focus().toggleBulletList().run()
        },
        {
            sel: '[data-hs-editor-blockquote]',
            fn: () => editor.chain().focus().toggleBlockquote().run()
        },
        {
            sel: '[data-hs-editor-code]',
            fn: () => editor.chain().focus().toggleCode().run()
        },
    ];

    actions.forEach(({
        sel,
        fn
    }) => {
        document.querySelector(`#csr-editor ${sel}`)?.addEventListener('click', fn);
    });
</script>

<script>
    function csrForm(csrf_token) {
        return {
            csrf_token,
            submitting: false,
            imagePreview: null,
            imageFile: null,

            form: {
                csr_title: '',
                csr_content: '',
                csr_date: '',
                csr_active: true,
            },

            errors: {
                csr_title: '',
                csr_content: '',
                csr_date: '',
                csr_image: '',
            },

            previewImage(e) {
                const file = e.target.files[0];
                if (!file) return;

                if (file.size > 2 * 1024 * 1024) {
                    this.errors.csr_image = 'Image must be smaller than 2MB.';
                    e.target.value = '';
                    return;
                }

                this.errors.csr_image = '';
                this.imageFile = file;
                this.imagePreview = URL.createObjectURL(file);
            },

            removeImage() {
                this.imagePreview = null;
                this.imageFile = null;
                const input = document.getElementById('csr_image');
                if (input) input.value = '';
            },

            validate() {
                let valid = true;
                this.errors = {
                    csr_title: '',
                    csr_content: '',
                    csr_date: '',
                    csr_image: ''
                };

                if (!this.form.csr_title.trim()) {
                    this.errors.csr_title = 'Title is required.';
                    valid = false;
                }

                // Pull latest HTML from Tiptap in case sync missed anything
                if (window.__csrEditor) {
                    this.form.csr_content = window.__csrEditor.getHTML();
                }

                if (!this.form.csr_content || this.form.csr_content === '<p></p>') {
                    this.errors.csr_content = 'Content is required.';
                    valid = false;
                }

                if (!this.form.csr_date) {
                    this.errors.csr_date = 'Activity date is required.';
                    valid = false;
                }

                return valid;
            },

            async submit() {
                if (!this.validate()) return;

                this.submitting = true;

                const payload = new FormData();
                payload.append('csrf_token', this.csrf_token);
                payload.append('csr_title', this.form.csr_title);
                payload.append('csr_content', this.form.csr_content);
                payload.append('csr_date', this.form.csr_date);
                payload.append('csr_inactive', this.form.csr_active ? '0' : '1');

                if (this.imageFile) {
                    payload.append('csr_image', this.imageFile);
                }

                try {
                    const res = await fetch('/api/csr', {
                        method: 'POST',
                        body: payload
                    });
                    const json = await res.json();

                    if (!res.ok) {
                        // Server-side validation errors
                        if (json.errors) {
                            Object.assign(this.errors, json.errors);
                        }
                        return;
                    }

                    // Update CSRF token from response
                    if (json.csrf_token) this.csrf_token = json.csrf_token;

                    window.location.href = '/admin/csr';
                } catch (err) {
                    console.error('Submit error:', err);
                } finally {
                    this.submitting = false;
                }
            },
        };
    }
</script>
<?= $this->endSection() ?>