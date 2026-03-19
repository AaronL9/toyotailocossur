<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<body class="flex flex-col min-h-screen">
    <div>
        <!-- New Vehicles Section (sidebar + grid layout) -->
        <section class="bg-slate-50 min-h-120 p-10" aria-labelledby="new-vehicles-heading">
            <div class="max-w-6xl mx-auto flex flex-col lg:flex-row lg:min-h-140">
                <!-- Left: Sidebar -->
                <aside
                    class="lg:w-56 xl:w-64 shrink-0 border-b lg:border-b-0 lg:border-r border-slate-200 bg-white lg:rounded-l-2xl overflow-hidden">
                    <div class="px-5 pt-5 pb-4 border-b border-slate-100">
                        <h2 id="new-vehicles-heading"
                            class="text-slate-800 font-bold text-sm tracking-widest uppercase">
                            New Vehicles
                            <div class="animate-pulse">
                            </div>
                        </h2>
                    </div>
                    <nav class="py-3 px-4" aria-label="Tabs" role="tablist">
                        <ul class="space-y-0.5">
                            <!-- <a class="block py-2.5 px-3 text-black font-medium text-sm border-l-2 border-red-500 bg-red-100/80 -ml-px pl-3 rounded-r">
                            </a> -->
                            <?php foreach ($vehicles_category as $row): ?>
                                <li>
                                    <a type="button" class="hs-tab-active:border-l-2 hs-tab-active:border-red-500 hs-tab-active:bg-red-100/80 hs-tab-active:font-medium block py-2.5 px-3 text-black hover:text-slate-800 hover:bg-slate-50 text-sm border-l-2 border-transparent rounded-r transition-colors <?= $row->cat_no == 1 ? "active" : "" ?>" id="vertical-tab-item-<?= $row->cat_no ?>" aria-selected="<?= $row->cat_no == 1 ? "true" : "false" ?>" data-hs-tab="#vertical-tab-<?= $row->cat_no ?>" aria-controls="vertical-tab-<?= $row->cat_no ?>" role=" tab">
                                        <?= $row->cat_title ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </aside>

                <!-- Right: Content + close -->
                <div class="flex-1 flex flex-col bg-white lg:border lg:border-l-0 border-transparent min-h-0">
                    <div class="flex justify-end pt-4 pr-4 lg:pt-5 lg:pr-6"></div>
                    <div class="flex-1 px-4 pb-8 lg:px-8 lg:max-h-[535.500px] lg:pb-10 overflow-auto">

                        <!-- id="vehicle-cat-container" -->
                        <?php foreach ($vehicles_category as $row): ?>
                            <div id="vertical-tab-<?= $row->cat_no ?>" role="tabpanel" aria-labelledby="vertical-tab-item-<?= $row->cat_no ?>" class="grid grid-cols-2 sm:grid-cols-3 gap-6 sm:gap-8 <?= $row->cat_no == 1 ? "" : "hidden" ?>">
                                <?php foreach ($vehicles as $vehicle): ?>
                                    <?php if ($vehicle->cat_no == $row->cat_no): ?>
                                        <article class="group">
                                            <a href="/<?= url_title($vehicle->vehicle_title, '-', true) ?>" class="block">
                                                <div class="aspect-4/3 bg-zinc-100 overflow-hidden mb-3 group-hover:shadow-md transition-all duration-200">
                                                    <img class="w-full h-full object-contain object-center p-2" src="/img/variants/<?= $vehicle->variant_filename ?>" alt="<?= $vehicle->vehicle_title ?>" loading="lazy">
                                                </div>
                                                <h3 class="text-slate-800 font-semibold text-center text-sm sm:text-base"><?= $vehicle->vehicle_title ?></h3>
                                                <p class="text-red-600 font-semibold text-center text-xs sm:text-sm tracking-widest uppercase mt-1 group-hover:underline">Explore</p>
                                            </a>
                                        </article>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?= $this->endSection() ?>