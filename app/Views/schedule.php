<?= $this->extend("layout/default"); ?>
<?= $this->section("mainContent"); ?>
<?= $this->include("partials/breadcrumb"); ?>


<body class="flex flex-col min-h-screen">

    <div class="mx-auto py-10" x-data="schedule">
        <section class="bg-neutral-100 text-white border border-black py-12 md:py-16 px-4"
            aria-labelledby="toyota-inquiry-heading">
            <div class="max-w-5xl mx-auto">
                <h2 id="toyota-inquiry-heading" class="sr-only">
                    Toyota Service Inquiry
                </h2>

                <form @submit.prevent="onSubmitContact($event)" method="post" class="space-y-8">
                    <?= csrf_field('csrf_field') ?>

                    <!-- DB flags -->
                    <input type="hidden" name="inquiry_inactive" value="0" />
                    <input type="hidden" name="inquiry_delete" value="0" />

                    <div class="grid md:grid-cols-2 gap-8 md:gap-10">
                        <!-- LEFT: TOYOTA VEHICLE + SCHEDULE -->
                        <div class="space-y-6">
                            <div>
                                <p class="text-lg font-semibold text-black tracking-[0.18em] uppercase mb-5 p-2">
                                    Your Toyota Vehicle
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <!-- vehicle_no (model) -->
                                    <div>
                                        <label for="vehicle_no" class="sr-only">Model</label>
                                        <select id="vehicle_no" name="vehicle_no"
                                            class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none disabled:opacity-50 disabled:pointer-events-none">
                                            <option value="">Model</option>

                                            <!-- Replace values with your internal IDs -->
                                            <option value="wigo">Wigo</option>
                                            <option value="vios">Vios</option>
                                            <option value="yaris">Yaris</option>
                                            <option value="corolla-altis">Corolla Altis</option>
                                            <option value="corolla-cross">Corolla Cross</option>
                                            <option value="camry">Camry</option>
                                            <option value="rav4">RAV4</option>
                                            <option value="fortuner">Fortuner</option>
                                            <option value="hilux">Hilux</option>
                                            <option value="innova">Innova</option>
                                        </select>
                                    </div>

                                    <!-- inquiry_year -->
                                    <div>
                                        <label for="inquiry_year" class="sr-only">Year</label>
                                        <select id="inquiry_year" name="inquiry_year"
                                            class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none">
                                            <option value="">Year</option>
                                            <option>2026</option>
                                            <option>2025</option>
                                            <option>2024</option>
                                            <option>2023</option>
                                            <option>2022</option>
                                            <option>2021</option>
                                            <option>2020</option>
                                        </select>
                                    </div>

                                    <!-- inquiry_plateno -->
                                    <div>
                                        <label for="inquiry_plateno" class="sr-only">Plate No.</label>
                                        <input id="inquiry_plateno" name="inquiry_plateno" type="text"
                                            class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none"
                                            placeholder="Plate No." />
                                    </div>

                                    <!-- inquiry_milage -->
                                    <div>
                                        <label for="inquiry_mileage" class="sr-only">Mileage</label>
                                        <select id="inquiry_mileage" name="inquiry_mileage"
                                            class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none">
                                            <option value="">Mileage</option>
                                            <option>5k</option>
                                            <option>10k</option>
                                            <option>20k</option>
                                            <option>30k</option>
                                            <option>40k</option>
                                            <option>50k</option>
                                            <option>60k</option>
                                            <option>70k</option>
                                            <option>80k</option>
                                            <option>90k</option>
                                            <option>100k</option>
                                            <option>110k</option>
                                            <option>120k</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <p class="text-md font-semibold tracking-[0.18em] uppercase text-black mb-5 p-2">
                                    Preferred Service Schedule
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                    <!-- inquiry_appointment_date -->
                                    <div>
                                        <label for="inquiry_appointment_date" class="sr-only">Date</label>
                                        <input id="inquiry_appointment_date" name="inquiry_appointment_date" type="date"
                                            class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none" />
                                    </div>

                                    <!-- inquiry_appointment_time -->
                                    <div>
                                        <label for="inquiry_appointment_time" class="sr-only">Time</label>
                                        <select id="inquiry_appointment_time" name="inquiry_appointment_time"
                                            class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none" />
                                        <option value="">Time</option>
                                        <option>8:00am</option>
                                        <option>8:30am</option>
                                        <option>9:00am</option>
                                        <option>9:30am</option>
                                        <option>10:00am</option>
                                        <option>10:30am</option>
                                        <option>11:00am</option>
                                        <option>11:30am</option>
                                        <option>12:00am</option>
                                        <option>12:30am</option>
                                        <option>1:00am</option>
                                        <option>1:30am</option>
                                        <option>2:00am</option>
                                        <option>2:30am</option>
                                        <option>3:00am</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT: GUEST DETAILS -->
                        <div class="space-y-3">
                            <p class="text-md text-black font-semibold tracking-[0.18em] uppercase mb-5 p-2">
                                Your Details
                            </p>

                            <!-- inquiry_name -->
                            <div>
                                <label for="name" class="sr-only">Name</label>
                                <input id="name" name="name" type="text" required
                                    class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none"
                                    placeholder="Full Name" />
                            </div>

                            <!-- inquiry_email -->
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input id="email" name="email" type="email" required
                                    class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none"
                                    placeholder="Email" />
                            </div>

                            <!-- inquiry_contact -->
                            <div>
                                <label for="contact" class="sr-only">Contact Number</label>
                                <input id="contact" name="contact" type="tel" required
                                    class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-full border border-gray-200 shadow-sm placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none"
                                    placeholder="Mobile Number" />
                            </div>

                            <!-- inquiry_content -->
                            <div>
                                <label for="message" class="sr-only">Notes</label>
                                <textarea id="message" name="message" rows="3"
                                    class="py-2.5 px-4 block w-full bg-white text-sm text-gray-900 rounded-2xl border border-gray-200 shadow-sm placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-500/20 focus:outline-none resize-y"
                                    placeholder="Tell us more about your concern or requested service."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER NOTE + CTA -->
                    <div class="text-center space-y-4">
                        <p class="text-xs md:text-sm text-red-500">
                            Please request your Toyota service appointment at least two (2)
                            days before your preferred date.
                        </p>
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-x-3 rounded-full border border-transparent bg-gray-900 px-8 md:px-10 py-3 text-xs md:text-sm font-semibold tracking-[0.16em] uppercase text-white hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#eb0a1e] focus:ring-gray-900">
                            Request a Toyota Service Schedule
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gray-800">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>

<?= $this->endSection() ?>