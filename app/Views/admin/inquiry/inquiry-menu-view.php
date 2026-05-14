<?= $this->extend("admin/layout/control-panel"); ?>

<?= $this->section("breadcrump") ?>

<?= $this->endSection() ?>

<?= $this->section("page") ?>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

    <!-- Contact Form Submissions -->
    <a href="/admin/inquiry/contacts" class="group flex flex-col bg-white border border-gray-200 rounded-xl p-6 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
        <div class="flex items-center gap-x-4 mb-3">
            <div class="size-10 flex items-center justify-center bg-blue-100 rounded-lg">
                <svg class="size-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                </svg>
            </div>
        </div>
        <h3 class="font-semibold text-gray-800">Contact Form Submissions</h3>
        <p class="mt-1 text-sm text-gray-500">View all users who filled up the contact us form.</p>
        <div class="mt-auto flex items-center gap-x-1 text-sm text-blue-600">
            View table
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Vehicle Inquiry Submissions -->
    <a href="/admin/inquiry/vehicle-inquiries" class="group flex flex-col bg-white border border-gray-200 rounded-xl p-6 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
        <div class="flex items-center gap-x-4 mb-3">
            <div class="size-10 flex items-center justify-center bg-green-100 rounded-lg">
                <svg class="size-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 17H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v3" />
                    <rect x="9" y="11" width="14" height="10" rx="2" />
                    <circle cx="12" cy="20" r="1" />
                    <circle cx="20" cy="20" r="1" />
                </svg>
            </div>
        </div>
        <h3 class="font-semibold text-gray-800">Vehicle Inquiry Submissions</h3>
        <p class="mt-1 text-sm text-gray-500">View all users who inquired about a specific vehicle.</p>
        <div class="mt-auto flex items-center gap-x-1 text-sm text-green-600">
            View table
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <!-- Service Appointment Scheduling -->
    <a href="/admin/inquiry/appointments" class="group flex flex-col bg-white border border-gray-200 rounded-xl p-6 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
        <div class="flex items-center gap-x-4 mb-3">
            <div class="size-10 flex items-center justify-center bg-yellow-100 rounded-lg">
                <svg class="size-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
            </div>
        </div>
        <h3 class="font-semibold text-gray-800">Service Appointment Scheduling</h3>
        <p class="mt-1 text-sm text-gray-500">Manage and view all users who scheduled a service appointment for their vehicle.</p>
        <div class="mt-auto flex items-center gap-x-1 text-sm text-yellow-600">
            View table
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </div>
    </a>

</div>
<?= $this->endSection() ?>