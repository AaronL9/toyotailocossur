<?= $this->extend("admin/layout/default.php"); ?>

<?= $this->section('login_content') ?>

<div class="flex flex-col min-h-screen bg-black justify-center">
  <div class="flex-1 flex items-center justify-center">
    <div class="w-full max-w-md">
      <!-- Logo -->
      <div class="text-center mb-8">
        <img class="mx-auto h-40 w-auto object-contain" src="/img/ilocos-sur-white-DHIjoD-c.png" alt="Logo">
        <h2 class="mt-6 text-3xl text-white">
          Sign in to your account
        </h2>
      </div>

      <!-- Login Card -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <?php if (session()->getFlashdata("login_error")): ?>
          <div class="flex items-center gap-4 mb-2 bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-soft-color-danger-label">
            <span id="hs-soft-color-danger-label" class="font-bold">
              <div class="shrink-0">
                <svg class="shrink-0 size-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10" />
                  <path d="M12 16v-4" />
                  <path d="M12 8h.01" />
                </svg>
              </div>
            </span>
            <?= session()->getFlashdata("login_error") ?>
          </div>
        <?php endif; ?>

        <form action="/admin/login" method="post" class="space-y-6">
          <?= csrf_field(); ?>
          <!-- Email Floating Input -->
          <div class="max-w-sm w-full space-y-3">
            <div class="relative">
              <input required type="text" name="username" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-line-2 sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-t-transparent focus:border-x-transparent focus:border-b-primary-focus focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Enter username">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                <svg class="shrink-0 size-4 text-muted-foreground-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
              </div>
            </div>

            <div class="relative">
              <input required type="password" name="password" class="peer py-2.5 sm:py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-line-2 sm:text-sm text-foreground placeholder:text-muted-foreground-1 focus:border-t-transparent focus:border-x-transparent focus:border-b-primary-focus focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Enter password">
              <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                <svg class="shrink-0 size-4 text-muted-foreground-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z" />
                  <circle cx="16.5" cy="7.5" r=".5" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
            Log in
          </button>
        </form>
      </div>
    </div>
  </div>

  <footer class="bg-black text-center py-5 mt-auto">
    <p class="text-gray-400">© Toyota Ilocos Sur. <?= date("Y") ?> All Rights Reserved</p>
  </footer>
</div>



<?= $this->endSection() ?>