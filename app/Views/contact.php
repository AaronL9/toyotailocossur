<?= $this->extend("layout/default"); ?>

<?= $this->section("mainContent"); ?>

<!-- Contact Us Section -->
<section class="py-16 md:py-24 px-4 md:px-8 bg-slate-50" aria-labelledby="contact-heading">
    <div class="max-w-6xl mx-auto">
        <header class="text-center mb-12 md:mb-16">
            <h2 id="contact-heading" class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight">
                Contact Us
            </h2>
            <p class="text-slate-600 mt-2 max-w-lg mx-auto">
                Get in touch with our team. We’re here to help with any questions
                about our vehicles and services.
            </p>
        </header>

        <div class="grid md:grid-cols-2 gap-10 lg:gap-16">
            <!-- Contact info -->
            <div class="space-y-8">
                <div>
                    <h3 class="text-slate-800 font-semibold text-sm uppercase tracking-wider mb-4">
                        Visit or call
                    </h3>
                    <ul class="space-y-4 text-slate-600">
                        <li class="flex gap-3">
                            <span
                                class="shrink-0 w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center text-slate-600"
                                aria-hidden="true">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-medium text-slate-800">Showroom address</p>
                                <p>
                                    123 Automotive Drive, Suite 100<br />City, State 12345
                                </p>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <span
                                class="shrink-0 w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center text-slate-600"
                                aria-hidden="true">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-medium text-slate-800">Phone</p>
                                <p>
                                    <a href="tel:+15551234567" class="hover:text-red-600 transition-colors">+1
                                        (555) 123-4567</a>
                                </p>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <span
                                class="shrink-0 w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center text-slate-600"
                                aria-hidden="true">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-medium text-slate-800">Email</p>
                                <p>
                                    <a href="mailto:hello@example.com"
                                        class="hover:text-red-600 transition-colors">hello@example.com</a>
                                </p>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <span
                                class="shrink-0 w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center text-slate-600"
                                aria-hidden="true">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-medium text-slate-800">Hours</p>
                                <p>
                                    Mon – Fri: 9:00 AM – 7:00 PM<br />Sat: 9:00 AM – 5:00 PM
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact form -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
                <h3 class="text-slate-800 font-semibold text-sm text-center uppercase tracking-wider mb-6">
                    Send a message
                </h3>
                <form class="space-y-5" action="#" method="post">
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="contact-name"
                                class="block text-sm font-medium text-slate-700 mb-1.5">Name</label>
                            <input type="text" id="contact-name" name="name" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 outline-none transition"
                                placeholder="Your name" />
                        </div>
                        <div>
                            <label for="contact-email"
                                class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                            <input type="email" id="contact-email" name="email" required
                                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 outline-none transition"
                                placeholder="you@example.com" />
                        </div>
                    </div>
                    <div>
                        <label for="contact-phone"
                            class="block text-sm font-medium text-slate-700 mb-1.5">Phone</label>
                        <input type="tel" id="contact-phone" name="phone"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 outline-none transition"
                            placeholder="+63 123 456 7890" />
                    </div>
                    <div>
                        <label for="contact-message"
                            class="block text-sm font-medium text-slate-700 mb-1.5">Message</label>
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
        </div>
    </div>
</section>
<?= $this->endSection() ?>