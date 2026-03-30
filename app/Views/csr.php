<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<body class="flex flex-col min-h-screen">
    <section class="py-16 md:py-24 px-4 md:px-8 bg-slate-50" aria-labelledby="contact-heading">
        <div class="max-w-6xl mx-auto">
            <header class="text-center mb-12 md:mb-16">
                <h2 id="contact-heading" class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">
                    CSR Initiatives
                </h2>
                <p class="text-slate-600 mt-2 max-w-lg mx-auto">
                    Driving sustainable mobility while creating positive impact for people and the planet.
                </p>
            </header>
        </div>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

            <!-- ── Card 1 ── -->
            <article
                class="csr-card rounded-2xl overflow-hidden border border-gray-100 bg-white shadow-sm flex flex-col">
                <div class="card-img-wrap h-auto bg-gray-100">
                    <img src="/img/CSR1.png" alt="Hearty Giving" class="w-full h-full object-cover" />
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <time class="text-xs text-toyota-muted font-medium mb-2 block">February 25, 2021</time>
                    <h3 class="csr-title font-display text-lg font-bold leading-snug mb-3 text-toyota-dark">
                        <span>Hearty Giving: Off to Make a Difference!</span>
                    </h3>
                    <p class="text-sm text-toyota-muted leading-relaxed flex-1">
                        In celebration of Valentine's Day, Toyota La Union's Marketing Team visited Forest Lake in
                        Bauang to donate relief goods to community members in need, as part of its CSR activities.
                    </p>
                </div>
            </article>

            <!-- ── Card 2 ── -->
            <article
                class="csr-card rounded-2xl overflow-hidden border border-gray-100 bg-white shadow-sm flex flex-col">
                <div class="card-img-wrap h-auto bg-gray-100">
                    <img src="/img/CSR2.png" alt="Guapple Seedlings" class="w-full h-full object-cover" />
                    <div
                        class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1 flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-toyota-red" viewBox="0 0 24 24" fill="currentColor">
                            <ellipse cx="12" cy="12" rx="11" ry="6.5" fill="none" stroke="currentColor"
                                stroke-width="2" />
                            <ellipse cx="12" cy="12" rx="5" ry="11" fill="none" stroke="currentColor"
                                stroke-width="2" />
                            <line x1="1" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <span class="text-[10px] font-bold tracking-widest text-toyota-dark uppercase">Toyota La
                            Union</span>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <time class="text-xs text-toyota-muted font-medium mb-2 block">August 31, 2021</time>
                    <h3 class="csr-title font-display text-lg font-bold leading-snug mb-3 text-toyota-dark">
                        <span>200 Guapple Seedlings Donated for One Planet, One Nation</span>
                    </h3>
                    <p class="text-sm text-toyota-muted leading-relaxed flex-1">
                        Toyota La Union donated 200 guapple seedlings to the Sangguniang Kabataan of Bauang — planting
                        seeds of hope for a greener, better tomorrow.
                    </p>
                    <div class="mt-5 flex items-center justify-between">

                    </div>
                </div>
            </article>

            <!-- ── Card 3 ── -->
            <article
                class="csr-card rounded-2xl overflow-hidden border border-gray-100 bg-white shadow-sm flex flex-col">
                <div class="card-img-wrap h-auto bg-gray-100">
                    <img src="/img/CSR3.png" alt="Youth Education Drive" class="w-full h-full object-cover" />
                    <div
                        class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1 flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 text-toyota-red" viewBox="0 0 24 24" fill="currentColor">
                            <ellipse cx="12" cy="12" rx="11" ry="6.5" fill="none" stroke="currentColor"
                                stroke-width="2" />
                            <ellipse cx="12" cy="12" rx="5" ry="11" fill="none" stroke="currentColor"
                                stroke-width="2" />
                            <line x1="1" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <span class="text-[10px] font-bold tracking-widest text-toyota-dark uppercase">Toyota La
                            Union</span>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <time class="text-xs text-toyota-muted font-medium mb-2 block">October 10, 2022</time>
                    <h3 class="csr-title font-display text-lg font-bold leading-snug mb-3 text-toyota-dark">
                        <span>Youth Education Drive: Empowering the Next Generation</span>
                    </h3>
                    <p class="text-sm text-toyota-muted leading-relaxed flex-1">
                        Toyota La Union partnered with local schools to provide school supplies and scholarships,
                        championing quality education and brighter futures for the youth of La Union.
                    </p>
                </div>
            </article>
        </div>
    </section>
</body><?= $this->endSection() ?>