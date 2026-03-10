<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<!-- Main Layout -->
<main class="flex-1 max-w-7xl mx-auto px-6 md:px-8 py-16 md:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start lg:items-center">
        <!-- Left: Vehicle Image -->
        <div class="w-full flex justify-center">
            <div class="w-full max-w-4xl aspect-21/9 lg:aspect-video">
                <img src="/img/variants/<?= $cc->variant_filename ?>" class="w-full h-full object-contain" alt="" />
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
                    <?= $cc->vehicle_title ?>
                </h1>
                <p class="text-sm text-gray-500 mt-1">Variant / Trim Description</p>
            </div>

            <!-- Pricing -->
            <div class="space-y-1">
                <p class="text-xs tracking-widest text-gray-500">STARTS AT</p>
                <p class="text-3xl font-semibold">
                    PHP <?= number_format($cc->variant_price) ?><span class="text-sm font-normal">*</span>
                    <span class="text-sm text-gray-500">MSRP</span>
                </p>
                <p class="text-sm text-gray-600">PHP <?= number_format($cc->variant_price_month) ?>* / mo</p>
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
    <!-- <div class="border rounded-2xl p-8 mb-16 bg-gray-50">
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
    </div> -->

    <!-- Variant Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
        <!-- Card -->
        <?php foreach ($variants as $row): ?>
            <div class="space-y-4">
                <div class="min-w-full h-[120px]">
                    <img src="/img/variants/<?= $row->variant_filename ?>" class="w-full" alt="" />
                </div>

                <div>
                    <h4 class="font-bold text-xl"><?= $row->variant_model ?></h4>
                    <p class="text-md text-gray-600">PHP <?= number_format($row->variant_price, 0) ?> MSRP</p>
                    <p class="text-md text-gray-500">PHP 46,698 / mo</p>
                </div>

                <?php foreach ($row->specifications as $spec): ?>
                    <p class="text-sm md:text-black text-gray-800 leading-relaxed">
                        <span class="font-bold"><?= $spec['scat_title'] ?>:</span>
                        <?= $spec['vs_value'] ?>
                    </p>
                <?php endforeach; ?>
                <!-- <p class="text-sm md:text-black text-gray-800 leading-relaxed">
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
                </p> -->

                <a href="#" class="text-sm font-semibold text-red-600 hover:underline">
                    Full specs →
                </a>
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

        <!-- Exterior | Interior -->
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

<!-- Divider -->
<span class="mb-8 flex items-center">
    <span class="h-px flex-1 bg-linear-to-r from-transparent to-gray-300"></span>

    <span class="h-px flex-1 bg-linear-to-l from-transparent to-gray-300"></span>
</span>

<!-- Contact form -->
<div
    class="mb-6 mx-4 sm:mx-auto w-auto sm:w-full max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
    <h3 class="text-slate-800 font-semibold text-xl text-center uppercase tracking-wider mb-6">
        Inquire About This Vehicle
    </h3>
    <form class="space-y-5" action="#" method="post">
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



<?= $this->endSection() ?>