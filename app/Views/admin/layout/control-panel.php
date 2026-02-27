<?= $this->extend("admin/layout/default"); ?>

<?php $admin = session()->get("admin") ?>

<?= $this->section("sidebar"); ?>
<!-- Navigation Toggle -->
<div class="lg:hidden">
  <nav class="w-full bg-white border-b border-gray-200 px-4 py-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-3">
        <button type="button" class="inline-flex justify-center items-center size-9 text-gray-800 hover:bg-gray-100 rounded-lg" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-sidebar-footer" aria-label="Toggle navigation" data-hs-overlay="#hs-sidebar-footer">
          <!-- <i class="fa-solid fa-bars fa-lg"></i> -->
          <img src="/img/toyota-logo.png" alt="">
        </button>
        <span class="font-semibold text-lg text-gray-900">Control Panel</span>
      </div>
    </div>
  </nav>
</div>
<!-- End Navigation Toggle -->

<!-- Sidebar -->
<div id="hs-sidebar-footer" class="hs-overlay [--auto-close:lg] lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 w-64 hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform h-full hidden fixed top-0 start-0 bottom-0 z-60 bg-white border-e border-gray-200" role="dialog" tabindex="-1" aria-label="Sidebar">
  <div class="relative flex flex-col h-full">

    <!-- Header -->
    <header class="p-4 border-b border-gray-200">
      <div class="flex justify-between items-center">
        <div class="flex items-center gap-3">
          <!-- Logo/Icon -->
          <div class="flex items-center justify-center size-10 rounded-lg">
            <!-- <i class="fa-solid fa-gears text-white"></i> -->
            <img src="/img/toyota-logo.png" alt="">
          </div>
          <div>
            <h2 class="font-semibold text-gray-900">Control Panel</h2>
            <p class="text-xs text-gray-500">Admin Dashboard</p>
          </div>
        </div>

        <!-- Close Button (Mobile) -->
        <button type="button" class="lg:hidden inline-flex justify-center items-center size-7 text-gray-600 hover:bg-gray-100 rounded-full" data-hs-overlay="#hs-sidebar-footer">
          <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </button>
      </div>
    </header>
    <!-- End Header -->

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-1 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">

      <!-- Main Section -->
      <div class="mb-4">
        <p class="px-3 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicles</p>
        <ul class="space-y-0.5">
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= preg_match('#^admin/vehicles($|/)#', uri_string()) ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/vehicles") ?>">
              <i class="fa-solid fa-car w-5 text-center <?= preg_match('#^admin/vehicles($|/)#', uri_string()) ? "text-primary-600" : "text-gray-500" ?>"></i>
              Vehicles
            </a>
          </li>
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= preg_match('#^admin/vehicles-category($|/)#', uri_string()) ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/vehicles-category") ?>">
              <i class="fa-solid fa-sitemap w-5 text-center <?= preg_match('#^admin/vehicles-category($|/)#', uri_string()) ? "text-primary-600" : "text-gray-500" ?>"></i>
              Category
            </a>
          </li>
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= str_contains(uri_string(), "admin/inquiry") ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/inquiry") ?>">
              <i class="fa-solid fa-comment w-5 text-center <?= str_contains(uri_string(), "admin/inquiry") ? "text-primary-600" : "text-gray-500" ?>"></i>
              Inquiry
            </a>
          </li>
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= str_contains(uri_string(), "admin/banner") ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/banner") ?>">
              <i class="fa-solid fa-panorama w-5 text-center <?= str_contains(uri_string(), "admin/banner") ? "text-primary-600" : "text-gray-500" ?>"></i>
              Banner
            </a>
          </li>

          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= str_contains(uri_string(), "admin/users") ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/users") ?>">
              <i class="fa-solid fa-user-tie w-5 text-center <?= str_contains(uri_string(), "admin/users") ? "text-primary-600" : "text-gray-500" ?>"></i>
              Users
            </a>
          </li>
        </ul>
      </div>

      <!-- Management Section -->
      <div class="mb-4">
        <p class="px-3 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</p>
        <ul class="space-y-0.5">
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= str_contains(uri_string(), "admin/barangays") ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/barangays") ?>">
              <i class="fa-solid fa-house-chimney w-5 text-center <?= str_contains(uri_string(), "admin/barangays") ? "text-primary-600" : "text-gray-500" ?>"></i>
              Barangays
            </a>
          </li>
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= str_contains(uri_string(), "admin/departments") ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/departments") ?>">
              <i class="fa-solid fa-building w-5 text-center <?= str_contains(uri_string(), "admin/departments") ? "text-primary-600" : "text-gray-500" ?>"></i>
              Departments
            </a>
          </li>
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= str_contains(uri_string(), "admin/documents") ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/documents") ?>">
              <i class="fa-solid fa-file-lines w-5 text-center <?= str_contains(uri_string(), "admin/documents") ? "text-primary-600" : "text-gray-500" ?>"></i>
              Documents
            </a>
          </li>
        </ul>
      </div>

      <!-- System Section -->
      <div>
        <p class="px-3 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">System</p>
        <ul class="space-y-0.5">
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors <?= str_contains(uri_string(), "admin/configurations") ? "bg-primary-50 text-primary-600 hover:bg-primary-50" : "" ?>" href="<?= base_url("admin/configurations") ?>">
              <i class="fa-solid fa-gear w-5 text-center <?= str_contains(uri_string(), "admin/configurations") ? "text-primary-600" : "text-gray-500" ?>"></i>
              Configurations
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navigation -->

    <!-- Footer -->
    <footer class="p-3 border-t border-gray-200">
      <div class="hs-dropdown [--strategy:absolute] [--auto-close:inside] relative w-full inline-flex">
        <button id="hs-sidebar-footer-example-with-dropdown" type="button" class="w-full inline-flex items-center gap-x-3 p-3 text-start text-sm rounded-lg hover:bg-gray-100 transition-colors" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
          <img class="shrink-0 size-9 rounded-full ring-2 ring-gray-200" src="/img/noprofile.png" alt="Avatar">
          <div class="flex-1 text-start overflow-hidden">
            <p class="text-sm font-medium text-gray-900 truncate capitalize"><?= $admin['name'] ?></p>
            <p class="text-xs text-gray-500 truncate">Administrator</p>
          </div>
          <svg class="shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m7 15 5 5 5-5" />
            <path d="m7 9 5-5 5 5" />
          </svg>
        </button>

        <!-- Dropdown Menu -->
        <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-full transition-[opacity,margin] duration opacity-0 hidden z-20 mb-2 bg-white border border-gray-200 rounded-lg shadow-lg" role="menu" aria-orientation="vertical" aria-labelledby="hs-sidebar-footer-example-with-dropdown">
          <div class="p-1">
            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100" href="#">
              <i class="fa-solid fa-user w-4 text-gray-500"></i>
              My Account
            </a>
            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100" href="#">
              <i class="fa-solid fa-gear w-4 text-gray-500"></i>
              Settings
            </a>
            <div class="border-t border-gray-200 my-1"></div>
            <form action="/logout" class="w-full" method="post">
              <?= csrf_field() ?>
              <button type="submit" class="w-full flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50">
                <i class="fa-solid fa-arrow-right-from-bracket w-4"></i>
                Sign Out
              </button>
            </form>
          </div>
        </div>
      </div>
    </footer>
    <!-- End Footer -->
  </div>
</div>
<!-- End Sidebar -->
<?= $this->endSection(); ?>

<?= $this->section('adminContent') ?>

<main class="lg:ml-[255px] flex flex-col items-center">
  <div class="w-full py-4 px-8 bg-white border-b border-gray-200 flex justify-between">
    <?= $this->renderSection("breadcrump"); ?>
    <img src="img/black-toyotailocossur-logo.png" alt="Logo" width="150" height="150">
  </div>

  <section class="w-full px-6 py-6">
    <?= $this->renderSection("page"); ?>
  </section>
</main>

<?= $this->endSection() ?>