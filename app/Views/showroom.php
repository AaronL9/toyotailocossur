<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>
<?= $this->include("partials/breadcrumb"); ?>


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
                                    <a type="button" class="hs-tab-active:border-l-2 hs-tab-active:border-red-500 hs-tab-active:bg-red-100/80 hs-tab-active:font-medium block py-2.5 px-3 text-black hover:text-slate-800 hover:bg-slate-50 text-sm border-l-2 border-transparent rounded-r transition-colors <?= $row->vcat_no == 1 ? "active" : "" ?>" id="vertical-tab-item-<?= $row->vcat_no ?>" aria-selected="<?= $row->vcat_no == 1 ? "true" : "false" ?>" data-hs-tab="#vertical-tab-<?= $row->vcat_no ?>" aria-controls="vertical-tab-<?= $row->vcat_no ?>" role=" tab">
                                        <?= $row->vcat_title ?>
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
                        <?php foreach ($vehicles_category as $cat): ?>
                            <div id="vertical-tab-<?= $cat->vcat_no ?>" role="tabpanel" aria-labelledby="vertical-tab-item-<?= $cat->vcat_no ?>" class="grid grid-cols-2 sm:grid-cols-3 gap-6 sm:gap-8 <?= $cat->vcat_no == 1 ? "" : "hidden" ?>">
                                <?php foreach ($vehicles as $row): ?>
                                    <?php if ($cat->vcat_no == $row->vcat_no): ?>
                                        <article class="group">
                                            <a href="#" class="block">
                                                <div class="aspect-4/3 bg-zinc-100 overflow-hidden mb-3 group-hover:shadow-md transition-all duration-200">
                                                    <img class="w-full h-full object-contain object-center p-2" src="/img/variants/<?= $row->variant_filename ?>" alt="<?= $row->vehicle_title ?>" loading="lazy">
                                                </div>
                                                <h3 class="text-slate-800 font-semibold text-center text-sm sm:text-base"><?= $row->vehicle_title ?></h3>
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