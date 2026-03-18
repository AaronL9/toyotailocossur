<!DOCTYPE html>
<html lang="en" data-page="<?= isset($page) ? $page : "" ?>">

<head>
    <meta charset="UTF-8">
    <title>Toyota Ilocos Sur</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <base href="<?= base_url() ?>">
    <?= vite_css("src/main.ts") ?>
</head>

<body class=" flex flex-col min-h-screen">
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-black text-sm py-3 sticky top-0 z-50">
        <nav class="max-w-340 w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
            <a href="/" class="flex-none text-xl font-semibold dark:text-white focus:outline-hidden focus:opacity-80"
                aria-label="Brand">
                <img class="w-40 h-auto" src="/img/ilocos-sur-white-DHIjoD-c.png" alt="Logo" />
            </a>
            <div class="sm:order-3 flex items-center gap-x-2">
                <button type="button"
                    class="sm:hidden hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 bg-black stroke-white text-white hover:bg-transparent disabled:pointer-events-none"
                    id="hs-navbar-alignment-collapse" aria-expanded="false" aria-controls="hs-navbar-alignment"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-alignment">
                    <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle</span>
                </button>

                <a href="/schedule"
                    class="text-sm uppercase font-semibold group relative inline-flex h-10 items-center justify-center overflow-hidden rounded-md border border-red-600 bg-red-600 px-2 *:font-medium text-white">
                    Schedule Now
                </a>
            </div>

            <div id="hs-navbar-alignment"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2"
                aria-labelledby="hs-navbar-alignment-collapse">
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
                    <?php $links = [
                        "home" => "/",
                        "showroom" => "/showroom",
                        "about us" => "#team",
                        "contact us" => "/contact"
                    ] ?>

                    <?php foreach ($links as $key => $value): ?>
                        <?php $isActive = url_is($value) ?>
                        <a class="<?= $isActive ? "underline decoration-red-600 " : "" ?> uppercase text-white font-medium focus:outline-hidden hover:underline hover:decoration-red-600 underline-offset-2"
                            href="<?= $value ?>"><?= $key ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </header>

    <?= $this->renderSection("mainContent") ?>
    <!-- FOOTER -->
    <footer class="py-8 bg-black text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-6">
                <div>
                    <img src="/img/ilocos-sur-white-DHIjoD-c.png" class="h-10 bg-center w-auto" />
                    <p class="text-gray-300 text-sm pt-8">
                        Langlangca 2nd, Candon City, Ilocos sur
                    </p>
                </div>
                <div>
                    <h6 class="font-semibold text-sm mb-3 uppercase tracking-wide text-gray-400">
                        Quick Links
                    </h6>
                    <ul class="space-y-1 text-sm">
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white">Home</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white">Showroom</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-300 hover:text-white">About Us</a>
                        </li>
                        <li>
                            <a href="#news" class="text-gray-300 hover:text-white">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="md:text-right">
                    <h6 class="font-semibold text-sm mb-3 uppercase tracking-wide text-gray-400">
                        Office Hours
                    </h6>
                    <div class="text-sm text-gray-300 space-y-1">
                        <p>Mon – Fri: 8:00 AM – 5:00 PM</p>
                        <p>Saturday: 8:00 AM – 12:00 PM</p>
                        <p>Sunday: Closed</p>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-red-600" />
            <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-400 gap-2">
                <p>© 2026 Toyota Ilocos-Sur. All rights reserved.</p>
                <p>Powered by BStech Solutions</p>
            </div>
        </div>
    </footer>

    <?php if (getenv("CI_ENVIRONMENT") === 'development'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/src/main.ts"></script>

        <!-- Vite HMR + JS -->
    <?php else: ?>
        <script type="module" src="<?= vite_asset('src/main.ts'); ?>"></script>
    <?php endif; ?>
</body>

</html>