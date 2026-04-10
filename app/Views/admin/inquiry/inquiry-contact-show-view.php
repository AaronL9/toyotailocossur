<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("page") ?>
<div class="w-full max-w-3xl">

    <!-- Page Header -->
    <div class="flex items-center gap-x-3 mb-5">
        <a href="/admin/inquiry" class="inline-flex items-center justify-center size-9 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 hover:text-gray-800 focus:outline-none">
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <div>
            <h1 class="text-lg font-semibold text-gray-800">Contact Submission</h1>
            <p class="text-sm text-gray-500">#<?= esc($inquiry->id) ?></p>
        </div>
        <!-- <div class="ms-auto">
            <a href="/admin/inquiry/contact/delete/<?= esc($inquiry->id) ?>"
                onclick="return confirm('Are you sure you want to delete this inquiry?')"
                class="inline-flex items-center gap-x-2 text-sm px-3 py-2 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 focus:outline-none transition">
                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14H6L5 6" />
                    <path d="M10 11v6" />
                    <path d="M14 11v6" />
                    <path d="M9 6V4h6v2" />
                </svg>
                Delete
            </a>
        </div> -->
    </div>
    <!-- End Page Header -->

    <div class="border border-gray-200 rounded-xl px-6 py-6 bg-white">

        <!-- Inquirer identity -->
        <div class="flex items-center gap-x-4 mb-5">
            <div class="size-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-medium text-sm select-none">
                <?= strtoupper(mb_substr($inquiry->inquirer, 0, 2)) ?>
            </div>
            <div>
                <p class="text-[15px] font-semibold text-gray-800"><?= esc($inquiry->inquirer) ?></p>
                <p class="text-sm text-gray-500"><?= esc($inquiry->email) ?></p>
            </div>
        </div>

        <hr class="border-gray-100 mb-5">

        <!-- Fields grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 mb-5">
            <div>
                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400 mb-1">Full Name</p>
                <p class="text-sm text-gray-800"><?= esc($inquiry->inquirer) ?></p>
            </div>
            <div>
                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400 mb-1">Inquiry No.</p>
                <p class="text-sm text-gray-800 font-mono">#<?= esc($inquiry->id) ?></p>
            </div>
            <div>
                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400 mb-1">Email Address</p>
                <p class="text-sm text-blue-600"><?= esc($inquiry->email) ?></p>
            </div>
            <div>
                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400 mb-1">Phone Number</p>
                <p class="text-sm text-gray-800"><?= esc($inquiry->contact) ?></p>
            </div>
            <div class="sm:col-span-2">
                <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400 mb-1">Date Submitted</p>
                <p class="text-sm text-gray-800"><?= date('F j, Y — g:i A', strtotime($inquiry->date)) ?></p>
            </div>
        </div>

        <hr class="border-gray-100 mb-5">

        <!-- Message -->
        <div>
            <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400 mb-2">Message</p>
            <div class="bg-gray-50 border border-gray-100 rounded-lg p-4 text-sm text-gray-800 leading-relaxed whitespace-pre-wrap"><?= esc($inquiry->message) ?></div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>