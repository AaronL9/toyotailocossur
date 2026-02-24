<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>
<?= $this->include("partials/breadcrumb"); ?>


<div class="fixed inset-0 z-50 grid place-content-center bg-black/50 p-4 mx-auto" role="dialog" aria-modal="true"
    aria-labelledby="modalTitle">
    <div class="w-full max-w-lg rounded-lg bg-white p-6 shadow-lg">
        <h6 id="modalTitle" class="text-xl font-bold text-red-600 sm:text-xl">Data Privacy Notice</h6>

        <div class="mt-4">
            <div class="space-y-4 text-lg text-black">
                <p class="text-pretty">
                    Toyota Ilocos Sur is committed to ensuring that our customer information is
                    secured and protected. We ensure a high level of data protection and data
                    security when storing and transmitting data.
                </p>

                <p class="text-pretty">
                    Toyota Ilocos Sur delivers quality products and high-level service while upholding the highest
                    standards of data protection in compliance with the Data Privacy Act of 2012. Safeguarding your
                    personal information is the foundation of our customers’ trust.
                </p>
            </div>

            <button class="text-sm text-gray-700 pt-4">
                Click
                <span class="font-bold text-red-600 hover:text-red-700 underline underline-offset-2 cursor-pointer">
                    here
                </span>
                to read the Privacy Statement in full view more
            </button>

            <div id="view" class="hidden mt-4 text-sm text-gray-700 space-y-4">
                <p>
                    We require the information to understand your needs and provide you with a
                    better service and in particular for the following reasons:
                </p>

                <ol class="list-decimal pl-5 space-y-2">
                    <li>
                        Processing your application for and providing you with the products and
                        services of Toyota Ilocos Norte, affiliates, business partners, and
                        related companies.
                    </li>

                    <li>
                        Sending you marketing, advertising and promotional information about other
                        products and services that Toyota Ilocos Norte, affiliates, business
                        partners and related companies may be offering, and which Toyota Ilocos
                        Norte believes may be of interest or benefit to you/us by way of postal
                        mail and/or electronic transmission to my/our email address(es).
                    </li>

                    <li>
                        Utilizing your contact information for the purpose of conducting telephone
                        and online surveys to enhance understanding of a certain topic based on
                        the nature and purpose of the study conducted.
                    </li>

                    <li>
                        Disclosure of your personal information if reasonably necessary for one or
                        more enforcement related activities conducted by, or on behalf of, an
                        enforcement body in compliance to our company’s legal obligation.
                    </li>

                    <li>
                        Use/publish your photo and/or information in the company’s promotional
                        activities, materials, and/or social media for documentary purposes.
                    </li>
                </ol>

                <p>
                    The above information can only be processed following consent by the data
                    subject. We will not process/disclose your personal information to third
                    parties unless we have your permission or are required by law to do so. Your
                    personal data is subject to data secrecy. It must be treated as confidential
                    on a personal level and secured with suitable organizational and technical
                    measures to prevent unauthorized access, illegal processing or distribution,
                    as well as accidental loss, modification or destruction.
                </p>
            </div>
        </div>

        <footer class="mt-6 flex justify-end gap-2 pt-4">
            <div class="flex items-start gap-2">
                <input type="checkbox" id="korek" name="korek"
                    class="mt-1 h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500" />

                <label for="korek" class="text-sm text-gray-700">
                    I accept the terms in
                    <span class="font-semibold">Toyota Ilocos Sur</span>
                    Privacy Statement.
                </label>
            </div>
            <button type="button"
                class="rounded bg-red-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-700">
                Done
            </button>
        </footer>
    </div>
</div>


<?= $this->endSection() ?>