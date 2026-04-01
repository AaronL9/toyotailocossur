<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div class="w-full mx-auto" x-data="csrData('<?= csrf_hash() ?>')">

    <!-- Header -->
    <div class="flex justify-between items-center gap-3 mb-5">
        <div class="relative max-w-xs flex-1">
            <label for="hs-csr-search" class="sr-only">Search</label>
            <input @keyup="search($event)" type="text" id="hs-csr-search"
                class="py-2 px-3 ps-9 block w-full bg-layer border-layer-line shadow-2xs rounded-lg sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-primary-focus focus:ring-primary-focus"
                placeholder="Search CSR activities…">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </div>
        </div>

        <a href="/admin/csr/create"
            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-primary-950 border border-primary-line text-primary-foreground hover:bg-primary-hover focus:outline-hidden">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Add CSR
        </a>
    </div>

    <!-- Loading state -->
    <template x-if="loading">
        <div class="flex justify-center py-16">
            <div class="animate-spin inline-block size-8 border-3 border-current border-t-transparent rounded-full text-primary-600" role="status">
                <span class="sr-only">Loading…</span>
            </div>
        </div>
    </template>

    <!-- Card grid -->
    <template x-if="!loading">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <!-- Empty state -->
            <template x-if="csrList.length === 0">
                <div class="col-span-full text-center py-16 text-gray-400 text-sm">
                    No CSR activities found.
                </div>
            </template>

            <!-- CSR cards -->
            <template x-for="csr in csrList" :key="csr.csr_no">
                <div class="flex flex-col bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-accent-800 transition-colors">

                    <!-- Cover image -->
                    <div class="relative h-36 bg-gray-100 overflow-hidden shrink-0">
                        <template x-if="csr.csr_image">
                            <img :src="'/uploads/csr/' + csr.csr_image" :alt="csr.csr_title"
                                class="w-full h-full object-cover">
                        </template>
                        <template x-if="!csr.csr_image">
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="size-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                            </div>
                        </template>

                        <!-- Active toggle (overlaid on image) -->
                        <div class="absolute top-2 end-2">
                            <label class="relative inline-block w-11 h-6 cursor-pointer">
                                <input type="checkbox" class="peer sr-only"
                                    :checked="!csr.csr_inactive"
                                    @change="toggleActive(csr.csr_no, $event.target.checked)">
                                <span class="absolute inset-0 bg-gray-400/60 rounded-full transition-colors peer-checked:bg-primary-600"></span>
                                <span class="absolute top-0.5 start-0.5 size-5 bg-white rounded-full shadow-xs transition-transform peer-checked:translate-x-5"></span>
                            </label>
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="flex flex-col gap-3 p-4 flex-1">

                        <!-- Date -->
                        <div class="flex items-center gap-1.5">
                            <svg class="size-3.5 text-gray-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            <span x-text="formatDate(csr.csr_date)" class="text-[11px] text-gray-400"></span>
                        </div>

                        <!-- Title & content preview -->
                        <div>
                            <p x-text="csr.csr_title"
                                class="text-sm font-medium text-gray-900 leading-snug line-clamp-2"></p>
                            <p x-text="csr.csr_content"
                                class="text-xs text-gray-500 mt-1 line-clamp-3"></p>
                        </div>

                        <!-- Encoded by -->
                        <div class="flex items-center gap-1.5 text-[11px] text-gray-400 mt-auto">
                            <svg class="size-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <span>Encoded by&nbsp;
                                <span x-text="'#' + csr.csr_encode" class="font-medium text-gray-500"></span>
                            </span>
                            <span class="mx-0.5">·</span>
                            <span x-text="formatDate(csr.csr_encode_date)"></span>
                        </div>

                        <hr class="border-gray-100">

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <!-- View -->
                            <a :href="`/admin/csr/view/${csr.csr_no}`"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 text-xs font-medium py-1.5 px-2.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                View
                            </a>

                            <!-- Edit -->
                            <a :href="`/admin/csr/edit/${csr.csr_no}`"
                                class="flex-1 inline-flex items-center justify-center gap-1.5 text-xs font-medium py-1.5 px-2.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4Z" />
                                </svg>
                                Edit
                            </a>

                            <!-- Delete -->
                            <button @click="deleteRow(csr.csr_no)" type="button"
                                class="inline-flex items-center justify-center p-1.5 rounded-lg border border-gray-200 text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors">
                                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path d="M19 6 18 20H6L5 6m5 0V4h4v2" />
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>
            </template>
        </div>
    </template>

    <!-- Footer: count + pagination -->
    <div class="flex justify-between items-center mt-5">
        <p class="text-sm text-gray-500">
            <span x-text="pageDetails.total" class="font-medium text-gray-800"></span> results
        </p>

        <nav class="flex items-center gap-x-1" aria-label="Pagination">
            <button @click="prev($event)" x-bind:data-uri="pageDetails.previous" type="button"
                class="size-9 inline-flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-100 disabled:opacity-40 disabled:pointer-events-none"
                aria-label="Previous">
                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>
            <div class="flex items-center gap-x-1 text-sm text-gray-500">
                <span x-text="pageDetails.currentPage"
                    class="min-w-8 text-center border border-gray-200 text-gray-800 py-1.5 px-2 rounded-lg"></span>
                <span>of</span>
                <span x-text="pageDetails.pageCount"></span>
            </div>
            <button @click="next($event)" x-bind:data-uri="pageDetails.next" type="button"
                class="size-9 inline-flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-100 disabled:opacity-40 disabled:pointer-events-none"
                aria-label="Next">
                <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </nav>
    </div>
</div>

<script>
    window.APP = {
        flash: <?= json_encode(session()->getFlashdata()) ?>
    }

    function csrData(csrfHash) {
        return {
            loading: true,
            csrList: [],
            pageDetails: {
                total: 0,
                currentPage: 1,
                pageCount: 1,
                previous: null,
                next: null,
            },
            csrfHash,

            async init() {
                await this.fetchData('/admin/csr/list');
            },

            async fetchData(uri) {
                if (!uri) return;
                this.loading = true;
                try {
                    const res = await fetch(uri, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const json = await res.json();
                    this.csrList = json.data ?? [];
                    this.pageDetails = json.pageDetails ?? this.pageDetails;
                } catch (e) {
                    console.error('CSR fetch error:', e);
                } finally {
                    this.loading = false;
                }
            },

            async search(e) {
                const q = e.target.value.trim();
                await this.fetchData(`/admin/csr/list?search=${encodeURIComponent(q)}`);
            },

            async toggleActive(id, isChecked) {
                await fetch(`/admin/csr/toggle/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        inactive: isChecked ? 0 : 1,
                        _token: this.csrfHash
                    }),
                });
            },

            async deleteRow(id) {
                if (!confirm('Delete this CSR activity? This cannot be undone.')) return;
                await fetch(`/admin/csr/delete/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        _token: this.csrfHash
                    }),
                });
                await this.fetchData('/admin/csr/list');
            },

            prev(e) {
                this.fetchData(e.currentTarget.dataset.uri);
            },
            next(e) {
                this.fetchData(e.currentTarget.dataset.uri);
            },

            formatDate(dateStr) {
                if (!dateStr) return '—';
                return new Date(dateStr).toLocaleDateString('en-PH', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                });
            },
        };
    }
</script>
<?= $this->endSection() ?>