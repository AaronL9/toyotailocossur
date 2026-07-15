<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<!-- 404 -->
<section class="relative bg-black text-white overflow-hidden">
    <div class="absolute inset-0 -z-10">
        <img src="/img/banner2-DKS0BEOM.jpg" class="h-full w-full object-cover opacity-25" alt="" />
        <div class="absolute inset-0 bg-black/75"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 md:py-32 flex flex-col items-center text-center">

        <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Error 404</span>

        <h1 class="text-7xl sm:text-8xl md:text-9xl font-bold leading-none mt-6">
            4<span class="text-red-600">0</span>4
        </h1>

        <h2 class="text-2xl sm:text-3xl font-bold mt-8 max-w-xl">
            Looks like you've taken a wrong turn.
        </h2>

        <p class="text-gray-400 text-base sm:text-lg max-w-xl mt-4">
            The page you're looking for doesn't exist or may have been moved.
            Let's get you back on the road.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 mt-10">
            <a href="/"
                class="group relative inline-flex h-14 items-center justify-center rounded-full bg-red-600 py-1 pl-6 pr-14 font-medium text-white">
                <span class="z-10 pr-2 transition-colors group-hover:text-red-600">Back to Home</span>
                <div
                    class="absolute right-1 inline-flex h-12 w-12 items-center justify-center rounded-full bg-white transition-[width] group-hover:w-[calc(100%-8px)]">
                    <div class="flex items-center justify-center -translate-x-0.5">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-red-600">
                            <path
                                d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </a>

            <a href="/showroom"
                class="inline-flex h-14 items-center justify-center rounded-full border border-white/25 px-8 font-medium text-white hover:border-red-600 hover:bg-red-600 transition-colors">
                Browse Showroom
            </a>
        </div>
    </div>
</section>

<!-- QUICK LINKS -->
<section class="py-16 sm:py-20 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-red-600 font-semibold text-sm uppercase tracking-wider">Where to next</span>
            <h3 class="text-3xl md:text-4xl font-bold mt-3 text-gray-900">Popular Pages</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            <?php
            $quickLinks = [
                [
                    "label" => "Showroom",
                    "desc" => "Explore our full Toyota lineup",
                    "href" => "/showroom",
                ],
                [
                    "label" => "Schedule Service",
                    "desc" => "Book your maintenance appointment",
                    "href" => "/schedule",
                ],
                [
                    "label" => "About Us",
                    "desc" => "Meet the team driving the brand",
                    "href" => "/#team",
                ],
                [
                    "label" => "Contact Us",
                    "desc" => "Get in touch with our team",
                    "href" => "/contact",
                ],
            ];
            ?>
            <?php foreach ($quickLinks as $link): ?>
                <a href="<?= $link['href'] ?>"
                    class="group flex flex-col justify-between bg-gray-100 hover:bg-gray-900 rounded-lg p-6 transition-colors min-h-[152px]">
                    <div class="space-y-1.5">
                        <h4 class="font-semibold text-lg text-gray-900 group-hover:text-white transition-colors">
                            <?= $link['label'] ?>
                        </h4>
                        <p class="text-sm text-gray-500 group-hover:text-gray-400 transition-colors leading-relaxed">
                            <?= $link['desc'] ?>
                        </p>
                    </div>
                    <div class="flex justify-end mt-6">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-red-600 transition-transform group-hover:translate-x-1">
                            <path
                                d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>