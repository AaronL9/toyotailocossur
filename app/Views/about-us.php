<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>

<!-- HERO -->
<section class="relative bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <h1 class="text-4xl md:text-5xl font-bold mt-4 mb-4">About Us</h1>
        <p class="text-gray-300 text-base sm:text-lg max-w-2xl">
            "In line with Toyota Motor Philippines' (TMP) and its Toyota Dealers' commitment to uphold the objectives and principles of the Philippine Competition Act (Republic Act No. 10667), which was signed into law last July 21, 2015, TMP and its Toyota Dealers hereby issue this Statement of Commitment and Customer Welfare Commitment to reaffirm its dedication to fair, open, and competitive business practices."
        </p>
    </div>
</section>



<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-2 lg:px-2">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 text-justify">

            <!-- Statement of Commitment -->
            <div id="overview" class="scroll-mt-28 pb-10 lg:pb-0 border-b lg:border-b-0 lg:border-r border-gray-200 lg:pr-16">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2 mb-4">Statement of Commitment</h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>Toyota Motor Philippines Corporation (TMP) and its dealer network recognize the important role of the Philippine Competition Commission (PPC) in fostering fair competitions that benefits both Filipino consumers and the national economy.</p>
                    <p>Since its establishment in 1988, TMP has consistently sought to conduct its business with integrity, transparency, and accountability. While the company maintains that its terms and financing options for the sale of passenger vehicles, as well as its discount and rebate policies, are lawful, it acknowledges without admission of any liability that certain aspects of these practices could be perceived as raising concerns under the competition law. Recognizing the importance of continuous improvement of its business practices, and in line with its responsibility to operate lawfully and uphold the basic tenets of fairness and equity, TMP and its dealer remain committed to strengthening its compliance framework and ensuring that its conduct remains aligned with the principles of fair and open competition.</p>
                    <p>TMP and its dealers affirm that compliance with the Philippine Competition Act (PCA), its Implementing Rules and Regulations (IRR), and other applicable laws and regulations is a core component of its corporate governance framework. In line with this, TMP and its dealers underscore its commitment to ethical business practices, consumer welfare, and the prevention of anti-competitive conduct, consistent with the objectives of competition law.</p>
                </div>
            </div>

            <!-- Customer Welfare Commitment -->
            <div id="collection" class="scroll-mt-28">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2 mb-4">Customer Welfare Commitment</h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <ul class="space-y-3">
                        <li>
                            <span class="text-red-600">A.</span> <strong>Uphold Customer Choice and Promotion of Fair Competition</strong> – TMP, its dealers, and their marketing professionals commit to operating in a manner that ensures customers retain the freedom to select their preferred vehicle, financing, and product package. TMP and its dealers explicitly disavow practices such as forced in-house financing, excessive insurance premiums or accessory charges, bundling of additional units, or pricing schemes that exceed the Manufacturer's Suggested Retail Price (MSRP). Further, TMP commits to implement rebate programs which shall be reasonably non-discriminatory across all dealers and designed in compliance with the competition laws, and ensure that commercial arrangements and engagements respect and promote fair competition and business practices.
                        </li>
                        <li>
                            <span class="text-red-600">B.</span> <strong>Ensure Transparency - </strong> TMP, its dealers, and their marketing professionals commit to providing customers with clear, accurate and accessible information on pricing, payment options, vehicle allocation, delivery timelines, insurance, and accessory options before purchase based on available data. Dealers are expected to avoid any deceptive, misleading, or unfair trade practices in their interactions with the public. Dealers maintain sufficient documentation to demonstrate that customers were informed of their options.
                        </li>
                        <li>
                            <span class="text-red-600">C.</span> <strong>Uphold Consumer Rights –</strong> TMP, its dealers, and their marketing professionals commit to address customer concerns promptly and equitably.
                        </li>
                        <li>
                            <span class="text-red-600">D.</span> <strong>Comply with Legal and Regulatory Standards –</strong> TMP, its Dealers and marketing professionals pledge full adherence to all government regulations.
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>