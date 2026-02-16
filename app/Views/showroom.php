<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>


<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-black text-sm py-3 sticky top-0 z-50">
    <nav class="max-w-340 w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
        <a class="flex-none text-xl font-semibold dark:text-white focus:outline-hidden focus:opacity-80" href="#"
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
                <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
                <span class="sr-only">Toggle</span>
            </button>

            <button
                class="text-sm uppercase font-semibold group relative inline-flex h-10 items-center justify-center overflow-hidden rounded-md border border-red-600 bg-red-600 px-2 *:font-medium text-white">
                Schedule Now
            </button>
        </div>
        <div id="hs-navbar-alignment"
            class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2"
            aria-labelledby="hs-navbar-alignment-collapse">
            <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
                <a class="font-medium text-white focus:outline-hidden hover:underline hover:decoration-red-600 underline-offset-4"
                    href="#">HOME</a>
                <a class="font-medium text-white focus:outline-hidden hover:underline hover:decoration-red-600 underline-offset-4"
                    href="#">SHOWROOM</a>
                <a class="font-medium text-white focus:outline-hidden hover:underline hover:decoration-red-600 underline-offset-4"
                    href="#">ABOUT US</a>
                <a class="font-medium text-white focus:outline-hidden hover:underline hover:decoration-red-600 underline-offset-4"
                    href="#">CONTACT US</a>

                <a class="font-medium text-white focus:outline-hidden hover:underline hover:decoration-red-600 underline-offset-4"
                    href="#">CSR</a>
            </div>
        </div>
    </nav>
</header>
<div class="bg-neutral-200 px-10">
    <nav class="flex gap-x-2 m-3" aria-label="Breadcrumb">
        <ol class="flex items-center gap-1 text-sm text-blacks">
            <li>
                <a href="#" class="block transition-colors hover:underline hover:decoration-red-600 underline-offset-4">
                    Home
                </a>
            </li>

            <li class="rtl:rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5"></path>
                </svg>
            </li>

            <li>
                <a href="#" class="block transition-colors hover:underline hover:decoration-red-600 underline-offset-4">
                    Vehicle Category
                </a>
            </li>

            <li class="rtl:rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 20.247 6-16.5"></path>
                </svg>
            </li>

            <li>
                <a href="#" class="block transition-colors hover:underline hover:decoration-red-600 underline-offset-4">
                    Product
                </a>
            </li>
        </ol>
    </nav>
</div>
<!-- Main Layout -->
<main class="flex-1 max-w-7xl mx-auto px-6 md:px-8 py-16 md:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start lg:items-center">
        <!-- Left: Vehicle Image -->
        <div class="w-full flex justify-center">
            <div class="w-full max-w-4xl aspect-21/9 lg:aspect-video">
                <img src="/img/fortuner1-Q3IeaT8B.webp" class="w-full h-full object-contain" alt="" />
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="space-y-6 max-w-md mx-auto text-center lg:text-left lg:mx-0">
            <!-- Color Selector -->
            <div>
                <p class="text-xs tracking-widest text-gray-500 mb-3">
                    EXPLORE COLORS*
                </p>
                <div class="flex justify-center lg:justify-start gap-3">
                    <button class="w-8 h-8 rounded-full border bg-white"></button>
                    <button class="w-8 h-8 rounded-full border bg-gray-300"></button>
                    <button class="w-8 h-8 rounded-full border bg-black ring-2 ring-black"></button>
                    <button class="w-8 h-8 rounded-full border bg-gray-600"></button>
                    <button class="w-8 h-8 rounded-full border bg-blue-900"></button>
                </div>
            </div>

            <!-- Vehicle Name -->
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Vehicle Name Placeholder
                </h1>
                <p class="text-sm text-gray-500 mt-1">Variant / Trim Description</p>
            </div>

            <!-- Pricing -->
            <div class="space-y-1">
                <p class="text-xs tracking-widest text-gray-500">STARTS AT</p>
                <p class="text-3xl font-semibold">
                    PHP 1,XXX,XXX<span class="text-sm font-normal">*</span>
                    <span class="text-sm text-gray-500">MSRP</span>
                </p>
                <p class="text-sm text-gray-600">PHP XX,XXX* / mo</p>
            </div>

            <!-- Disclaimer -->
            <div class="text-xs text-gray-400 leading-relaxed">
                <p>
                    * Computations are estimates only. Pricing and availability may
                    vary by variant.
                </p>
                <p class="mt-2">
                    * Vehicle image shown may not reflect actual unit.
                </p>
            </div>

            <!-- CTA -->
            <div>
                <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:underline">
                    Inquire Now
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</main>

<span class="flex items-center">
    <span class="h-px flex-1 bg-linear-to-r from-transparent to-gray-300"></span>

    <span class="h-px flex-1 bg-linear-to-l from-transparent to-gray-300"></span>
</span>
<section class="max-w-7xl mx-auto px-6 md:px-8 py-20">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto mb-16">
        <h2 class="text-3xl md:text-4xl font-semibold tracking-tight">
            Choose your Fortuner variant
        </h2>
        <p class="text-gray-600 mt-4">
            Browse full specifications per variant and find the Fortuner that fits
            your lifestyle.
        </p>
    </div>

    <!-- Featured Variant -->
    <div class="border rounded-2xl p-8 mb-16 bg-gray-50">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <img src="/img/fortuner1-Q3IeaT8B.webp" alt="" class="w-full max-w-xl mx-auto" />

            <div class="space-y-6">
                <h3 class="text-2xl font-semibold">GR-S 4x4 AT</h3>

                <div>
                    <p class="text-sm text-gray-500">Starts at</p>
                    <p class="text-3xl font-semibold">
                        PHP 2,656,000 <span class="text-sm text-gray-500">MSRP</span>
                    </p>
                    <p class="text-sm text-gray-600">PHP 48,279 / mo</p>
                </div>

                <ul class="text-sm text-gray-700 space-y-2">
                    <li><strong>Engine:</strong> 2.8L Diesel Turbo</li>
                    <li><strong>Drivetrain:</strong> 4x4 Automatic</li>
                    <li><strong>Brakes:</strong> Ventilated Disc (Front & Rear)</li>
                </ul>

                <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:underline">
                    Full Specs
                    <span>→</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Variant Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <!-- Card -->
        <div class="space-y-4">
            <img src="/img/fortuner1-Q3IeaT8B.webp" class="w-full" alt="" />

            <div>
                <h4 class="font-bold text-xl">2.8 LTD 4x4 AT</h4>
                <p class="text-md text-gray-600">PHP 2,569,000 MSRP</p>
                <p class="text-md text-gray-500">PHP 46,698 / mo</p>
            </div>

            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Engine:</span>
                4-Cylinder, In-Line, 16-Valve DOHC Variable Nozzle Turbo with
                Air-cooled Intercooler
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Suspension:</span>
                Double Wishbone + Monotube Shock Absorber (Front), Multi-Link
                <br />+ Monotube Shock Absorber (Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Brakes:</span>
                Ventilated Disc (Front and Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Fuel:</span>
                Diesel
            </p>

            <a href="#" class="text-sm font-semibold text-red-600 hover:underline">
                Full specs →
            </a>
        </div>

        <!-- Repeat -->
        <div class="space-y-4">
            <img src="/img/fortuner1-Q3IeaT8B.webp" class="w-full" alt="" />

            <div>
                <h4 class="font-bold text-xl">2.8 LTD 4x4 AT</h4>
                <p class="text-md text-gray-600">PHP 2,569,000 MSRP</p>
                <p class="text-md text-gray-500">PHP 46,698 / mo</p>
            </div>

            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Engine:</span>
                4-Cylinder, In-Line, 16-Valve DOHC Variable Nozzle Turbo with
                Air-cooled Intercooler
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Suspension:</span>
                Double Wishbone + Monotube Shock Absorber (Front), Multi-Link
                <br />+ Monotube Shock Absorber (Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Brakes:</span>
                Ventilated Disc (Front and Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Fuel:</span>
                Diesel
            </p>

            <a href="#" class="text-sm font-semibold text-red-600 hover:underline">
                Full specs →
            </a>
        </div>

        <div class="space-y-4">
            <img src="/img/fortuner1-Q3IeaT8B.webp" class="w-full" alt="" />

            <div>
                <h4 class="font-bold text-xl">2.8 LTD 4x4 AT</h4>
                <p class="text-md text-gray-600">PHP 2,569,000 MSRP</p>
                <p class="text-md text-gray-500">PHP 46,698 / mo</p>
            </div>

            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Engine:</span>
                4-Cylinder, In-Line, 16-Valve DOHC Variable Nozzle Turbo with
                Air-cooled Intercooler
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Suspension:</span>
                Double Wishbone + Monotube Shock Absorber (Front), Multi-Link
                <br />+ Monotube Shock Absorber (Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Brakes:</span>
                Ventilated Disc (Front and Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Fuel:</span>
                Diesel
            </p>

            <a href="#" class="text-sm font-semibold text-red-600 hover:underline">
                Full specs →
            </a>
        </div>

        <div class="space-y-4">
            <img src="/img/fortuner1-Q3IeaT8B.webp" class="w-full" alt="" />

            <div>
                <h4 class="font-bold text-xl">2.8 LTD 4x4 AT</h4>
                <p class="text-md text-gray-600">PHP 2,569,000 MSRP</p>
                <p class="text-md text-gray-500">PHP 46,698 / mo</p>
            </div>

            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Engine:</span>
                4-Cylinder, In-Line, 16-Valve DOHC Variable Nozzle Turbo with
                Air-cooled Intercooler
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Suspension:</span>
                Double Wishbone + Monotube Shock Absorber (Front), Multi-Link
                <br />+ Monotube Shock Absorber (Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Brakes:</span>
                Ventilated Disc (Front and Rear)
            </p>
            <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                <span class="font-bold">Fuel:</span>
                Diesel
            </p>

            <button type="button" class="text-sm font-semibold text-red-600 hover:underline" aria-haspopup="dialog"
                aria-expanded="false" aria-controls="hs-scroll-inside-body-modal"
                data-hs-overlay="#hs-scroll-inside-body-modal">
                Full Specs →
            </button>

            <div id="hs-scroll-inside-body-modal"
                class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
                role="dialog" tabindex="-1" aria-labelledby="hs-scroll-inside-body-modal-label">
                <div
                    class="bg-white hs-overlay-open:mt-7 hs-overlay-open:opacity-300 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 h-[calc(100%-56px)] sm:mx-auto">
                    <div
                        class="max-h-full overflow-hidden flex flex-col bg-overlay border border-overlay-line shadow-2xs rounded-xl pointer-events-auto">
                        <div class="flex justify-between items-center py-3 px-4 border-b border-overlay-header">
                            <h3 id="hs-scroll-inside-body-modal-label" class="font-semibold text-foreground">
                                Full specs for Fortuner 2.8 LTD 4x4 AT
                            </h3>
                            <button type="button"
                                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full bg-white border border-surface-line text-surface-foreground hover:bg-surface-hover focus:outline-hidden focus:bg-surface-focus disabled:opacity-50 disabled:pointer-events-none"
                                aria-label="Close" data-hs-overlay="#hs-scroll-inside-body-modal">
                                <span class="sr-only">Close</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto">
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-foreground">
                                        Be bold
                                    </h3>
                                    <p class="mt-1 text-foreground">
                                        Motivate teams to do their best work. Offer best
                                        practices to get users going in the right direction. Be
                                        bold and offer just enough help to get the work started,
                                        and then get out of the way. Give accurate information
                                        so users can make educated decisions. Know your user's
                                        struggles and desired outcomes and give just enough
                                        information to let them get where they need to go.
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-black">
                                        Be optimistic
                                    </h3>
                                    <p class="mt-1 text-foreground">
                                        Focusing on the details gives people confidence in our
                                        products. Weave a consistent story across our fabric and
                                        be diligent about vocabulary across all messaging by
                                        being brand conscious across products to create a
                                        seamless flow across all the things. Let people know
                                        that they can jump in and start working expecting to
                                        find a dependable experience across all the things. Keep
                                        teams in the loop about what is happening by informing
                                        them of relevant features, products and opportunities
                                        for success. Be on the journey with them and highlight
                                        the key points that will help them the most - right now.
                                        Be in the moment by focusing attention on the important
                                        bits first.
                                    </p>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-foreground">
                                        Be practical, with a wink
                                    </h3>
                                    <p class="mt-1 text-foreground">
                                        Keep our own story short and give teams just enough to
                                        get moving. Get to the point and be direct. Be concise -
                                        we tell the story of how we can help, but we do it
                                        directly and with purpose. Be on the lookout for
                                        opportunities and be quick to offer a helping hand. At
                                        the same time realize that nobody likes a nosy neighbor.
                                        Give the user just enough to know that something awesome
                                        is around the corner and then get out of the way. Write
                                        clear, accurate, and concise text that makes interfaces
                                        more usable and consistent - and builds trust. We strive
                                        to write text that is understandable by anyone,
                                        anywhere, regardless of their culture or language so
                                        that everyone feels they are part of the team.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-overlay-footer">
                            <button type="button"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white border border-layer-line text-layer-foreground shadow-2xs hover:bg-layer-hover focus:outline-hidden focus:bg-layer-focus disabled:opacity-50 disabled:pointer-events-none"
                                data-hs-overlay="#hs-scroll-inside-body-modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-16 md:py-24 px-4 md:px-8" aria-labelledby="gallery-heading">
    <div class="max-w-7xl mx-auto">
        <!-- Section header -->
        <header class="text-center mb-12 md:mb-16">
            <p class="text-auto-accent text-sm font-semibold tracking-widest uppercase mb-2">
                Explore
            </p>
            <h2 id="gallery-heading" class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight">
                Vehicle Gallery
            </h2>
            <p class="text-auto-silver/80 mt-3 max-w-xl mx-auto text-lg">
                Exterior styling and interior craftsmanship in every detail.
            </p>
        </header>

        <!-- Preline Tabs: Exterior | Interior -->
        <div id="vehicle-gallery-tabs" class="mb-10">
            <nav class="flex flex-wrap gap-2 justify-center border-b border-white/10 pb-px" aria-label="Gallery views"
                role="tablist" data-hs-tabs='{"defaultSelected": "exterior-tab"}'>
                <button type="button"
                    class="active hs-tab-active:border-auto-accent hs-tab-active:text-red-600 border-b-2 border-transparent px-6 py-3 text-md font-large transition-all focus:outline-none focus:ring-2 focus:ring-auto-accent/50"
                    id="exterior-tab" data-hs-tab="#exterior-panel" aria-selected="true" aria-controls="exterior-panel"
                    role="tab">
                    Exterior
                </button>
                <button type="button"
                    class="hs-tab-active:border-auto-accent hs-tab-active:text-red-600 border-b-2 border-transparent text-auto-black px-6 py-3 text-md font-medium transition-all focus:outline-none focus:ring-2 focus:ring-auto-accent/50"
                    id="interior-tab" data-hs-tab="#interior-panel" aria-selected="false" aria-controls="interior-panel"
                    role="tab">
                    Interior
                </button>
            </nav>

            <!-- Exterior panel -->
            <div id="exterior-panel" role="tabpanel" aria-labelledby="exterior-tab" class="mt-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&q=80"
                            alt="Vehicle exterior front three-quarter view" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1502877338535-766e1452684a?w=800&q=80"
                            alt="Vehicle side profile" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=800&q=80"
                            alt="Vehicle rear view" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1542362567-b07e54358753?w=800&q=80"
                            alt="Vehicle front grille and headlights" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate sm:col-span-2">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=1200&q=80"
                            alt="Vehicle exterior in motion" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&q=80"
                            alt="Vehicle wheel and brake detail" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1609521263047-f8f205293f24?w=800&q=80"
                            alt="Vehicle at dusk" loading="lazy" />
                    </div>
                </div>
            </div>

            <!-- Interior panel (hidden by default) -->
            <div id="interior-panel" role="tabpanel" aria-labelledby="interior-tab" class="mt-10 hidden">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate sm:col-span-2">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1619767886558-efdc259cde1a?w=1200&q=80"
                            alt="Dashboard and steering wheel" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800&q=80"
                            alt="Front seats and center console" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80"
                            alt="Interior cabin and seats" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1616422285623-13ff0162193c?w=800&q=80"
                            alt="Infotainment and controls" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80"
                            alt="Rear seats and legroom" loading="lazy" />
                    </div>
                    <div class="group aspect-4/3 rounded-xl overflow-hidden bg-auto-slate sm:col-span-2">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=1200&q=80"
                            alt="Interior trim and materials" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

<?= $this->endSection() ?>