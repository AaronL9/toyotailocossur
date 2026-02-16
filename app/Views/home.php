<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>


<!-- Carousel -->
<div data-hs-carousel='{
    "loadingClasses": "opacity-0",
    "isAutoPlay": true
  }' class="relative">
    <div class="hs-carousel relative overflow-hidden w-full h-75 sm:h-100 md:h-125 lg:h-150 rounded-xl shadow-lg">
        <div
            class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
            <!-- Slide 1 -->
            <div class="hs-carousel-slide relative">
                <img src="/img/carousel1-xmi8Hsyg.jpg" class="w-full h-full object-cover" alt="Toyota Service" />
            </div>

            <!-- Slide 2 -->
            <div class="hs-carousel-slide relative">
                <img src="/img/carousel2-ExbEmYc-.jpg" class="w-full h-full object-cover" alt="Toyota Cars" />
            </div>

            <!-- Slide 3 -->
            <div class="hs-carousel-slide relative">
                <img src="/img/carousel3-DnPtD492.jpg" class="w-full h-full object-cover" alt="Toyota Showroom" />
            </div>

            <!-- Slide 4 -->
            <div class="hs-carousel-slide relative">
                <img src="/img/carousel3-DnPtD492.jpg" class="w-full h-full object-cover" alt="Toyota Showroom" />
            </div>
        </div>
    </div>

    <!-- Prev -->
    <button type="button"
        class="hs-carousel-prev absolute inset-y-0 start-0 flex items-center justify-center w-12 text-white hover:bg-black/30 transition">
        <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="m15 18-6-6 6-6" />
        </svg>
    </button>

    <!-- Next -->
    <button type="button"
        class="hs-carousel-next absolute inset-y-0 end-0 flex items-center justify-center w-12 text-white hover:bg-black/30 transition">
        <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="m9 18 6-6-6-6" />
        </svg>
    </button>

    <!-- dots -->
    <div class="hs-carousel-pagination flex justify-center absolute bottom-4 start-0 end-0 gap-2"></div>
</div>

<!-- Vehicle Cards Section -->
<section class="py-16 md:py-24 bg-base-100 bg-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12 gap-4">
            <div class="text-center md:text-left">
                <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Our Collection</span>
                <h2 class="text-4xl md:text-5xl font-bold mt-4 mb-2">
                    Featured Vehicles
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl md:max-w-none">
                    Discover our premium selection of Toyota vehicles
                </p>
            </div>
        </div>

        <!-- Vehicle Card 1 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="group flex flex-col overflow-hidden bg-gray-100 shadow-lg">
                <div class="relative overflow-hidden bg-gray-100">
                    <img src="/img/fortuner1-Q3IeaT8B.webp" class="w-full h-64 object-contain" />
                    <div class="flex flex-col flex-1 p-5 bg-linear-to-br from-gray-900 to-black text-white">
                        <h3 class="text-2xl font-semibold mb-2">Fortuner</h3>
                        <div class="space-y-1 mb-4">
                            <p class="text-sm text-gray-300">Starting at</p>
                            <p class="text-2xl font-bold">
                                PHP 1,775,000<span class="text-sm">*</span>
                            </p>
                            <p class="text-gray-300">
                                PHP 32,265<span class="text-sm">*</span> / month
                            </p>
                        </div>
                        <button
                            class="group relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md bg-red-600 px-6 font-medium text-neutral-200">
                            <span>Full Specs</span>
                            <div
                                class="w-0 translate-x-full pl-0 opacity-0 transition-all duration-200 group-hover:w-5 group-hover:translate-x-0 group-hover:pl-1 group-hover:opacity-100">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path
                                        d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vehicle Card 2 -->
            <div class="group flex flex-col rounded-xl overflow-hidden bg-gray-100 shadow-lg">
                <div class="relative overflow-hidden bg-gray-100">
                    <img src="/img/corollaCross-D7_CYBOE.png" class="w-full h-64 object-contain" />
                    <div class="flex flex-col flex-1 p-5 bg-linear-to-br from-gray-900 to-black text-white">
                        <h3 class="text-2xl font-semibold mb-2">Corolla Cross</h3>
                        <div class="space-y-1 mb-4">
                            <p class="text-sm text-gray-300">Starting at</p>
                            <p class="text-2xl font-bold">
                                PHP 1,775,000<span class="text-sm">*</span>
                            </p>
                            <p class="text-gray-300">
                                PHP 32,265<span class="text-sm">*</span> / month
                            </p>
                        </div>
                        <button
                            class="group relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md bg-red-600 px-6 font-medium text-neutral-200">
                            <span>Full Specs</span>
                            <div
                                class="w-0 translate-x-full pl-0 opacity-0 transition-all duration-200 group-hover:w-5 group-hover:translate-x-0 group-hover:pl-1 group-hover:opacity-100">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path
                                        d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vehicle Card 3 -->
            <div class="group flex flex-col rounded-xl overflow-hidden bg-gray-100 shadow-lg">
                <div class="relative overflow-hidden bg-gray-100">
                    <img src="/img/commuterDelux-P1xL9xdx.png" class="w-full h-64 object-contain" />
                    <div class="flex flex-col flex-1 p-5 bg-linear-to-br from-gray-900 to-black text-white">
                        <h3 class="text-2xl font-semibold mb-2">Commuter Deluxe</h3>
                        <div class="space-y-1 mb-4">
                            <p class="text-sm text-gray-300">Starting at</p>
                            <p class="text-2xl font-bold">
                                PHP 1,775,000<span class="text-sm">*</span>
                            </p>
                            <p class="text-gray-300">
                                PHP 32,265<span class="text-sm">*</span> / month
                            </p>
                        </div>
                        <button
                            class="group relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md bg-red-600 px-6 font-medium text-neutral-200">
                            <span>Full Specs</span>
                            <div
                                class="w-0 translate-x-full pl-0 opacity-0 transition-all duration-200 group-hover:w-5 group-hover:translate-x-0 group-hover:pl-1 group-hover:opacity-100">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path
                                        d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vehicle Card 4-->
            <div class="group flex flex-col rounded-xl overflow-hidden bg-gray-100 shadow-lg">
                <div class="relative overflow-hidden bg-gray-100">
                    <img src="/img/alphard-fdE3fjRk.png" class="w-full h-64 object-contain" />
                    <div class="flex flex-col flex-1 p-5 bg-linear-to-br from-gray-900 to-black text-white">
                        <h3 class="text-2xl font-semibold mb-2">Alphard</h3>
                        <div class="space-y-1 mb-4">
                            <p class="text-sm text-gray-300">Starting at</p>
                            <p class="text-2xl font-bold">
                                PHP 1,775,000<span class="text-sm">*</span>
                            </p>
                            <p class="text-gray-300">
                                PHP 32,265<span class="text-sm">*</span> / month
                            </p>
                        </div>
                        <button
                            class="group relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md bg-red-600 px-6 font-medium text-neutral-200">
                            <span>Full Specs</span>
                            <div
                                class="w-0 translate-x-full pl-0 opacity-0 transition-all duration-200 group-hover:w-5 group-hover:translate-x-0 group-hover:pl-1 group-hover:opacity-100">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path
                                        d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center md:justify-end mb-8 p-6">
            <button
                class="group relative inline-flex h-14 items-center justify-center rounded-full bg-red-600 py-1 pl-6 pr-14 font-medium text-white">
                <span class="z-10 pr-2 transition-colors group-hover:text-red-600">View All Vehicles</span>
                <div
                    class="absolute right-1 inline-flex h-12 w-12 items-center justify-end rounded-full bg-white transition-[width] group-hover:w-[calc(100%-8px)]">
                    <div class="mr-3.5 flex items-center justify-center">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-red-600">
                            <path
                                d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </button>
        </div>
    </div>
</section>

<!-- HERO SECTION -->
<section class="relative lg:grid lg:h-screen lg:place-content-center">
    <div class="absolute inset-0 -z-10">
        <img src="/img/banner2-DKS0BEOM.jpg" class="h-full w-full object-cover" alt="" />
        <div class="absolute inset-0 bg-black/60"></div>
    </div>
    <div
        class="mx-auto w-screen max-w-7xl px-4 py-16 sm:px-6 sm:py-24 md:grid md:grid-cols-2 md:items-center md:gap-4 lg:px-8 lg:py-32">
        <div class="max-w-prose text-left text-white">
            <h1 class="text-4xl font-bold sm:text-5xl">
                Driven by
                <strong class="text-red-500"> Innovation. </strong>
                Powered by Results
            </h1>

            <p class="mt-4 text-base sm:text-lg/relaxed text-white/90">
                Welcome to Toyota Ilocos-Sur
            </p>
        </div>
    </div>
</section>

<!-- SERVICE SECTION -->
<section id="services" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left -->
            <div>
                <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">
                    Expert Care
                </span>

                <h2 class="text-4xl md:text-5xl font-bold mt-4 mb-6 text-gray-900">
                    Schedule Toyota Service
                </h2>

                <p class="text-gray-600 text-lg mb-6">
                    Keep your Toyota running at peak performance with our expert
                    maintenance services. Schedule your appointment online and
                    experience professional care from certified technicians.
                </p>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-gray-700">Certified Toyota Technicians</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-gray-700">Genuine Toyota Parts</span>
                    </li>

                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-600 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-gray-700">Quick &amp; Convenient Scheduling</span>
                    </li>
                </ul>

                <button
                    class="group relative inline-flex h-14 items-center justify-center rounded-full bg-red-600 py-1 pl-6 pr-14 font-medium text-white">
                    <span class="z-10 pr-2 transition-colors group-hover:text-red-600">Schedule Maintenance</span>
                    <div
                        class="absolute right-1 inline-flex h-12 w-12 items-center justify-end rounded-full bg-white transition-[width] group-hover:w-[calc(100%-8px)]">
                        <div class="mr-3.5 flex items-center justify-center">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600">
                                <path
                                    d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </button>
            </div>

            <!-- Right -->
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <img src="/img/maintenance-GiBGTARx.jpg" alt="Toyota Service Center"
                        class="w-full h-auto object-cover" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meet our Team -->
<section class="bg-zinc-800 text-white py-16 px-6 md:px-16 lg:px-24 xl:px-32">
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <!-- Left Content - Image Gallery -->
        <div class="grid grid-cols-2 gap-6 max-w-2xl mx-auto lg:mx-0">
            <!-- Card 1 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-xl cursor-pointer">
                <img class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                    src="/img/employee9-B5EfZgH9.png" alt="Team Member 1" />
                <div
                    class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/90 via-black/60 to-transparent p-4">
                    <h3 class="text-white font-semibold text-lg mb-1">
                        First Name Last Name
                    </h3>
                    <p class="text-gray-300 text-xs mb-2">Marketing Professional</p>
                    <div class="space-y-1 text-xs text-gray-300">
                        <p>email@example.com</p>
                        <p>+63 XXX XXX XXXX</p>
                        <div class="flex gap-3 items-center">
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Facebook</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Instagram</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Twitter</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-xl cursor-pointer mt-12">
                <img class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-105"
                    src="/img/employee8-CVNAixpJ.png" alt="Team Member 2" />
                <div
                    class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/90 via-black/60 to-transparent p-4">
                    <h3 class="text-white font-semibold text-lg mb-1">
                        First Name Last Name
                    </h3>
                    <p class="text-gray-300 text-xs mb-2">Marketing Professional</p>
                    <div class="space-y-1 text-xs text-gray-300">
                        <p>email@example.com</p>
                        <p>+63 XXX XXX XXXX</p>
                        <div class="flex gap-3 items-center">
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Facebook</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Instagram</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Twitter</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-xl cursor-pointer">
                <img class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                    src="/img/employee7-BK6GwSxi.png" alt="Team Member 3" />
                <div
                    class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/90 via-black/60 to-transparent p-4">
                    <h3 class="text-white font-semibold text-lg mb-1">
                        First Name Last Name
                    </h3>
                    <p class="text-gray-300 text-xs mb-2">[Position]</p>
                    <div class="space-y-1 text-xs text-gray-300">
                        <p>email@example.com</p>
                        <p>+63 XXX XXX XXXX</p>
                        <div class="flex gap-3 items-center">
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Facebook</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Instagram</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Twitter</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-xl cursor-pointer mt-12">
                <img class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-105"
                    src="/img/employee2-Bl7UKlja.png" alt="Team Member 4" />
                <div
                    class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/90 via-black/60 to-transparent p-4">
                    <h3 class="text-white font-semibold text-lg mb-1">
                        First Name Last Name
                    </h3>
                    <p class="text-gray-300 text-xs mb-2">Marketing Professional</p>
                    <div class="space-y-1 text-xs text-gray-300">
                        <p>delavegajanrichard@gmail.com</p>
                        <p>+63 999 157 9413</p>
                        <div class="flex gap-3 items-center">
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Facebook</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Instagram</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" rel="noreferrer" target="_blank"
                                class="text-gray-700 transition hover:opacity-75 dark:text-gray-200">
                                <span class="sr-only">Twitter</span>

                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Content - Text and Button -->
        <div class="flex flex-col items-center lg:items-start gap-6">
            <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">
                Meet our team
            </span>
            <h2 class="text-center lg:text-left text-4xl md:text-5xl/16 max-w-lg leading-tight text-white">
                The team driving the brand forward.
            </h2>
            <p class="text-center lg:text-left text-sm text-white max-w-md">
                Our marketing specialists, strategists, and storytellers connect
                drivers with the innovation and reliability of Toyota Motor
                Corporation through campaigns that inspire trust and loyalty.
            </p>
            <button
                class="group relative inline-flex h-12 items-center justify-center overflow-hidden rounded-md border border-red-600 bg-red-600 px-6 font-medium text-white transition-all duration-100 [box-shadow:5px_5px_rgb(153_27_27)] active:translate-x-0.75 active:translate-y-0.75 active:[box-shadow:0px_0px_rgb(153_27_27)]">
                Contact Us
            </button>
        </div>
    </div>
</section>



<?= $this->endSection() ?>