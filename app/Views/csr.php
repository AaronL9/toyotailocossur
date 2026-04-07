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
            <?php foreach ($articles as $row): ?>
                <article
                    class="csr-card rounded-2xl overflow-hidden border border-gray-100 bg-white shadow-sm flex flex-col">
                    <div class="card-img-wrap h-56.25 bg-gray-100">
                        <img src="/img/csr/<?= $row->csr_image ?>" alt="Hearty Giving" class="w-full h-full object-cover" />
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <time class="text-xs text-toyota-muted font-medium mb-2 block">February 25, 2021</time>
                        <h3 class="csr-title font-display text-lg font-bold leading-snug mb-3 text-toyota-dark">
                            <span><?= $row->csr_title ?></span>
                        </h3>
                        <p class="text-sm text-toyota-muted leading-relaxed flex-1">
                            <?= $row->csr_content ?>
                        </p>
                    </div>
                </article>
            <?php endforeach ?>
        </div>
    </section>
</body><?= $this->endSection() ?>