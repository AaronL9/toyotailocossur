<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<!-- HERO -->
<section class="relative bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-4">About Us</h1>
    </div>
</section>

<section class="py-16 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-2 lg:px-2">
        <p class="text-black text-base mb-5">
            "In line with Toyota Motor Philippines' (TMP) and its Toyota Dealers' commitment to uphold the objectives and principles of the Philippine Competition Act (Republic Act No. 10667), which was signed into law last July 21, 2015, TMP and its Toyota Dealers hereby issue this Statement of Commitment and Customer Welfare Commitment to reaffirm its dedication to fair, open, and competitive business practices."
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-4 text-justify">
            <!-- Statement of Commitment -->
            <div id="overview" class="scroll-mt-28 p-10">
                <img src="/static/statement-of-commitment-a4.jpg" alt="">
            </div>

            <!-- Customer Welfare Commitment -->
            <div id="collection" class="p-10">
                <img src="/static/customer-welfare-commitment-a4.jpg" alt="">
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>