<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<div x-data="vehiclePage()">
    <!-- Main Layout -->
    <main class="flex-1 max-w-7xl mx-auto px-6 md:px-8 py-16 md:py-20">
        <div x-data="{ activeImage: '/img/variants/<?= $cc->variant_filename ?>', isLoading: true}" class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start lg:items-center">
            <!-- Left: Vehicle Image -->
            <div class="w-full flex justify-center">
                <div class="w-full max-w-4xl aspect-21/9 lg:aspect-video flex justify-center items-center">
                    <img @load="isLoading = false" x-cloak x-show="!isLoading" :src="activeImage" class="w-full h-full object-contain" alt="" />
                    <div x-show="isLoading" class="m-auto animate-spin inline-block size-8 border-3 border-current border-t-transparent rounded-[999px] text-primary" role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
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
                        <?php foreach ($cc->assets as $asset): ?>
                            <button
                                @click="activeImage = '/img/variants/<?= $asset['variant_filename'] ?>'; isLoading: true;"
                                style="background-color: <?= $asset['color_hex_value'] ?>;"
                                class="w-8 h-8 rounded-full border hover:scale-95"></button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Vehicle Name -->
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">
                        <?= $cc->vehicle_title ?>
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">Variant / Trim Description</p>
                </div>

                <?php if ($cc->variant_isshowprice): ?>
                    <!-- Pricing -->
                    <div class="space-y-1">
                        <p class="text-xs tracking-widest text-gray-500">STARTS AT</p>
                        <p class="text-3xl font-semibold">
                            PHP <?= number_format($cc->variant_price) ?><span class="text-sm font-normal">*</span>
                            <span class="text-sm text-gray-500">MSRP</span>
                        </p>
                        <p class="text-sm text-gray-600">PHP <?= number_format($cc->variant_price_month) ?>* / mo</p>
                    </div>
                <?php endif ?>

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
                    <a href="<?= url_title($cc->vehicle_title, '-', true) ?>/#vehicle-contact-form" class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:underline">
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
                Choose your <?= $cc->vehicle_title ?> variant
            </h2>
            <p class="text-gray-600 mt-4">
                Browse full specifications per variant and find the <?= $cc->vehicle_title ?> that fits
                your lifestyle.
            </p>
        </div>

        <!-- Variant Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Card -->
            <?php foreach ($variants as $row): ?>
                <div x-data="{ activeImage: '/img/variants/<?= $row->variant_filename ?>', isLoading: true}" class="space-y-4">
                    <div class="w-full max-w-4xl aspect-21/9 lg:aspect-video flex justify-center items-center">
                        <img @load="isLoading = false" x-cloak x-show="!isLoading" :src="activeImage" class="w-full h-full object-contain" alt="" />
                        <div x-show="isLoading" class="m-auto animate-spin inline-block size-8 border-3 border-current border-t-transparent rounded-[999px] text-primary" role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <div class="flex justify-center items-center lg:justify-start gap-3">
                        <span class="text-xs text-primary-700">Available in</span>
                        <?php foreach ($row->assets as $asset): ?>
                            <button
                                @click="activeImage = '/img/variants/<?= $asset['variant_filename'] ?>'; isLoading = true"
                                style="background-color: <?= $asset['color_hex_value'] ?>;"
                                class="w-4 h-4 rounded-full border"></button>
                        <?php endforeach; ?>
                    </div>

                    <div>
                        <h4 class="font-bold text-xl"><?= $row->variant_model ?></h4>
                        <?php if ($row->variant_isshowprice): ?>
                            <!-- Price -->
                            <p class="text-md text-gray-600">PHP <?= number_format($row->variant_price, 0) ?> MSRP</p>
                            <p class="text-md text-gray-500">PHP <?= number_format($row->variant_price_month, 0) ?> / mo</p>
                        <?php endif; ?>
                    </div>

                    <?php foreach ($row->specifications as $spec): ?>
                        <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                            <span class="font-bold"><?= $spec['scat_title'] ?>:</span>
                            <?= $spec['vs_value'] ?>
                        </p>
                    <?php endforeach; ?>

                    <button type="button" @click='showAccordionModal(<?= json_encode($row->fullSpecifications) ?>)' class="text-sm font-semibold text-red-600 hover:underline">
                        Full specs →
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

    </section>
    <span class="flex items-center">
        <span class="h-px flex-1 bg-linear-to-r from-transparent to-gray-300"></span>

        <span class="h-px flex-1 bg-linear-to-l from-transparent to-gray-300"></span>
    </span>

    <!-- Gallery Section -->
    <section class="py-16 md:py-24 px-4 md:px-8" aria-labelledby="gallery-heading">
        <div class="max-w-7xl mx-auto">
            <!-- Section header -->
            <header class="text-center mb-8 md:mb-10">
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

            <!-- Carousel -->
            <div data-hs-carousel='{
    "loadingClasses": "opacity-0"
  }' class="relative">
                <div class="hs-carousel flex flex-col sm:flex-row gap-2">
                    <div class="sm:order-2 relative grow overflow-hidden min-h-[500px] rounded-lg">
                        <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
                            <?php foreach ($gallery as $photo): ?>
                                <div class="hs-carousel-slide">
                                    <!-- <div class="flex justify-center h-full bg-surface p-6">
                                        <span class="self-center text-4xl text-foreground transition duration-700">First slide</span>
                                    </div> -->
                                    <img class="w-full h-full object-cover transition-transform duration-500 rounded"
                                        src="/img/gallery/<?= $photo->variant_filename ?>"
                                        alt="Dashboard and steering wheel" loading="lazy" />
                                </div>
                            <?php endforeach ?>
                        </div>

                        <!-- Arrows -->
                        <button type="button" class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:cursor-default absolute top-1/2 start-2 inline-flex justify-center items-center size-10 bg-layer text-layer-foreground rounded-full shadow-2xs hover:bg-layer-hover -translate-y-1/2 focus:outline-hidden">
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6" />
                                </svg>
                            </span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button type="button" class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:cursor-default absolute top-1/2 end-2 inline-flex justify-center items-center size-10 bg-layer text-layer-foreground rounded-full shadow-2xs hover:bg-layer-hover -translate-y-1/2 focus:outline-hidden">
                            <span class="sr-only">Next</span>
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </span>
                        </button>
                        <!-- End Arrows -->
                    </div>

                    <!-- Thumbnails -->
                    <div class="sm:order-1 flex-none">

                        <div class="hs-carousel-pagination max-h-[500px] flex flex-row sm:flex-col gap-2 overflow-x-auto sm:overflow-x-hidden sm:overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-scrollbar-track [&::-webkit-scrollbar-thumb]:bg-scrollbar-thumb">
                            <?php foreach ($gallery as $photo): ?>
                                <div class="hs-carousel-pagination-item shrink-0 border border-line-2 rounded-md overflow-hidden cursor-pointer size-20 sm:size-32 hs-carousel-active:border-primary">
                                    <div class="flex justify-center items-center text-center size-full bg-surface p-2">
                                        <!-- <span class="text-xs text-foreground transition duration-700">First slide</span> -->
                                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 rounded"
                                            src="/img/gallery/<?= $photo->variant_filename ?>"
                                            alt="Dashboard and steering wheel" loading="lazy" />
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <!-- End Thumbnails -->
                </div>
            </div>
            <!-- End Carousel -->
    </section>

    <!-- Divider -->
    <span class="mb-8 flex items-center">
        <span class="h-px flex-1 bg-linear-to-r from-transparent to-gray-300"></span>

        <span class="h-px flex-1 bg-linear-to-l from-transparent to-gray-300"></span>
    </span>

    <!-- Contact form -->
    <div id="vehicle-contact-form"
        class="mb-6 mx-4 sm:mx-auto w-auto sm:w-full max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
        <h3 class="text-slate-800 font-semibold text-xl text-center uppercase tracking-wider mb-6">
            Inquire About This Vehicle
        </h3>
        <form @submit.prevent="onSubmitContact($event)" class="space-y-5" action="#" method="post">
            <?= csrf_field('csrf_field') ?>
            <input type="hidden" name="vehicle" value="<?= $cc->variant_no ?>">
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="contact-name" class="block text-sm font-medium text-slate-700 mb-1.5">Name</label>
                    <input type="text" id="contact-name" name="name" required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 outline-none transition"
                        placeholder="Your name" />
                </div>
                <div>
                    <label for="contact-email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input type="email" id="contact-email" name="email" required
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 outline-none transition"
                        placeholder="you@example.com" />
                </div>
            </div>
            <div>
                <label for="contact-phone" class="block text-sm font-medium text-slate-700 mb-1.5">Phone</label>
                <input type="tel" id="contact-phone" name="phone"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 outline-none transition"
                    placeholder="+63 123 456 7890" />
            </div>
            <div>
                <label for="contact-message" class="block text-sm font-medium text-slate-700 mb-1.5">Message</label>
                <textarea id="contact-message" name="message" rows="4" required
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-500 outline-none transition resize-y"
                    placeholder="How can we help?"></textarea>
            </div>
            <div class="lg:flex lg:justify-center">
                <button type="submit"
                    class="items-center w-full sm:w-auto px-8 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                    Send message
                </button>
            </div>
        </form>
    </div>

    <!-- SweetAlert2 template: Preline accordion (popup uses customClass for container style) -->
    <template id="swal-vehicles-accordion">
        <swal-html>
            <div class="hs-accordion-group">
                <template x-for="(value, index) in $store.fullSpec">
                    <div class="hs-accordion" :id="`hs-basic-heading-${index}`">
                        <button class="hs-accordion-toggle hs-accordion-active:text-accent-600 px-6 py-3 inline-flex items-center gap-x-3 text-sm w-full font-semibold text-start text-gray-800 hover:text-gray-500 focus:outline-hidden focus:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none" aria-expanded="false" :aria-controls="`hs-basic-collapse-${index}`">
                            <svg class="hs-accordion-active:hidden hs-accordion-active:text-accent-600 hs-accordion-active:group-hover:text-accent-600 block size-4 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                            <svg class="hs-accordion-active:block hs-accordion-active:text-accent-600 hs-accordion-active:group-hover:text-accent-600 hidden size-4 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                            </svg>
                            <span x-text="index"></span>
                        </button>
                        <div :id="`hs-basic-collapse-${index}`" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" :aria-labelledby="`hs-basic-heading-${index}`">
                            <template x-for="row in value">
                                <div class="pb-4 px-6 flex justify-between">
                                    <p x-text="row.spec_title" class="text-sm capitalize text-gray-600"></p>
                                    <p x-text="row.vs_value" class="w-44 text-right text-sm text-gray-600"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </swal-html>
        <swal-footer>
            <div class="flex justify-end gap-x-2">
                <button @click="$store.Swal.close()" type="button" class="py-2 px-4 inline-flex items-center gap-x-1.5 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 transition-colors duration-150">
                    Close
                </button>
            </div>
        </swal-footer>
    </template>
</div>

<!-- At the bottom before </body> -->
<script>
    // function changeColor(btn) {
    //     // Swap image
    //     document.getElementById('variant-image').src = btn.dataset.image;

    //     // Reset all buttons
    //     document.querySelectorAll('[data-image]').forEach(b => {
    //         b.classList.remove('ring-2', 'ring-offset-2', 'ring-gray-400');
    //     });

    //     // Highlight selected
    //     btn.classList.add('ring-2', 'ring-offset-2', 'ring-gray-400');
    // }
</script>

<?= $this->endSection() ?>