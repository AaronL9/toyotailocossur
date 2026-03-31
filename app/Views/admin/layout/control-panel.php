<?= $this->extend("admin/layout/default"); ?>

<?php $admin = session()->get("admin") ?>

<?= $this->section("sidebar"); ?>
<!-- Navigation Toggle -->
<div class="lg:hidden sticky top-0 z-10">
  <nav class="w-full bg-white border-b border-gray-200 px-4 py-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-3">
        <button type="button" class="inline-flex justify-center items-center size-9 text-gray-800 hover:bg-gray-100 rounded-lg" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-sidebar-footer" aria-label="Toggle navigation" data-hs-overlay="#hs-sidebar-footer">
          <i class="fa-solid fa-bars fa-lg"></i>
        </button>
        <div class="flex items-center gap-4">
          <div class="leading-tight">
            <p class="text-sm font-semibold text-gray-800 tracking-wide">Toyota Ilocos Sur</p>
            <p class="text-[10px] text-gray-400 tracking-widest uppercase">Dealer Management System</p>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <div class="h-[3px] bg-[#CC0000] w-full"></div>
</div>
<!-- End Navigation Toggle -->

<!-- Sidebar -->
<div id="hs-sidebar-footer" class="hs-overlay [--auto-close:lg] lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 w-64 hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform h-full hidden fixed top-0 start-0 bottom-0 z-60 bg-white border-e border-gray-200" role="dialog" tabindex="-1" aria-label="Sidebar">
  <div class="relative flex flex-col h-full">

    <!-- Header -->
    <header class="h-16 p-4">
      <div class="flex justify-between items-center">
        <div class="flex items-center gap-3">
          <!-- Logo/Icon -->
          <div class="flex items-center justify-center size-10 rounded-lg">
            <div class="w-9 h-9 rounded-lg bg-[#CC0000] flex items-center justify-center flex-shrink-0">
              <img src="/img/toyota-logo.png" alt="Toyota" class="w-5 h-5 object-contain brightness-0 invert">
            </div>
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

      <ul class="space-y-0.5">
        <?php foreach ($modules as $row): ?>
          <?php if (in_array($row->mod_no, $access)) : ?>
            <li>
              <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium rounded-lg transition-colors <?= preg_match("#^{$row->mod_link}($|/)#", uri_string()) ? "bg-accent-50 text-accent-800 hover:bg-accent-50" : "hover:bg-gray-100" ?>" href="<?= $row->mod_link ?>">
                <i class="<?= $row->mod_icon ?> w-5 text-center <?= preg_match("#^{$row->mod_link}($|/)#", uri_string()) ? "text-accent-800" : "text-gray-500" ?>"></i>
                <?= $row->mod_title ?>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <!-- <div class="mb-4">
        <p class="px-3 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicles</p>
        <ul class="space-y-0.5">
          <li>
            <a class="flex items-center gap-x-3 py-2.5 px-3 text-sm font-medium rounded-lg transition-colors <?= preg_match('#^admin/vehicles($|/)#', uri_string()) ? "bg-accent-50 text-accent-800 hover:bg-accent-50" : "hover:bg-gray-100" ?>" href="<?= base_url("admin/vehicles") ?>">
              <i class="fa-solid fa-car w-5 text-center <?= preg_match('#^admin/vehicles($|/)#', uri_string()) ? "text-accent-800" : "text-gray-500" ?>"></i>
              Vehicles
            </a>
          </li>
        </ul>
      </div> -->
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
            <form action="/admin/logout" class="w-full" method="post">
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
  <!-- Navbar -->
  <header class="lg:block hidden w-full bg-white border-b border-gray-100 sticky top-0 z-50">

    <!-- Main bar -->
    <div class="px-8 h-16 flex items-center justify-between">

      <!-- Logo + Brand Identity -->
      <div class="flex items-center gap-4">
        <!-- <img src="img/black-toyotailocossur-logo.png" alt="Toyota Ilocos Sur" class="h-8 w-auto object-contain"> -->
        <!-- <span class="block w-px h-7 bg-gray-200"></span> -->
        <div class="leading-tight">
          <p class="text-sm font-semibold text-gray-800 tracking-wide">Toyota Ilocos Sur</p>
          <p class="text-[10px] text-gray-400 tracking-widest uppercase">Dealer Management System</p>
        </div>
      </div>

      <!-- Right: Status + Date -->
      <div class="flex items-center gap-5">
        <div class="flex items-center gap-2">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
          <span class="text-xs text-gray-400">System Online</span>
        </div>
        <span class="w-px h-4 bg-gray-200"></span>
        <span class="text-xs text-gray-400 tabular-nums" id="navbar-date"></span>
      </div>

    </div>

    <!-- Toyota Red accent line -->
    <div class="h-[3px] bg-[#CC0000] w-full"></div>

  </header>

  <section class="w-full px-6 py-6">
    <?= $this->renderSection("page"); ?>
  </section>
</main>

<script>
  const el = document.getElementById('navbar-date');
  if (el) el.textContent = new Date().toLocaleDateString('en-PH', {
    weekday: 'short',
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  });
</script>

<?= $this->endSection() ?>