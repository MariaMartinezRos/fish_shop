<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('home' ) }}">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <img src="{{ asset('images/go-back.png') }}" alt="{{ __('Go Back')}}" >
                {{ __('Go Back') }}
            </h2>
        </a>
    </x-slot>

                <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
                <h1 class="text-3xl font-bold text-center text-blue-700">{{ __('Privacy Policy') }}</h1>
                <p class="text-center text-gray-600">{{ __('Last updated: January 2, 2025') }}</p>

                <p class="mt-4">{{ __('At') }} <strong>{{ __('Benito\'s Fish Markets') }}</strong>, {{ __('customer privacy is our priority. This Privacy Policy explains how we collect, use, and protect your personal information when you visit our website.') }}</p>

                <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('1. Information We Collect') }}</h2>
                <p>{{ __('When you interact with our website, we may collect the following information:') }}</p>
                <ul class="list-disc list-inside ml-4">
                    <li><strong>{{ __('Personal Data:') }}</strong> {{ __('Name, email address, phone number, shipping and billing address (when making a purchase or subscribing to our newsletter).') }}</li>
                    <li><strong>{{ __('Browsing Data:') }}</strong> {{ __('IP address, device type, browser used, visited pages, and browsing duration.') }}</li>
                    <li><strong>{{ __('Payment Information:') }}</strong> {{ __('For online purchases, payment details are securely processed through third-party payment platforms.') }}</li>
                </ul>

                <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('2. Use of Information') }}</h2>
                <p>{{ __('We use the collected information for the following purposes:') }}</p>
                <ul class="list-disc list-inside ml-4">
                    <li>{{ __('Processing orders and managing shipments.') }}</li>
                    <li>{{ __('Providing customer support and responding to inquiries.') }}</li>
                    <li>{{ __('Sending promotional communications (with prior user consent).') }}</li>
                    <li>{{ __('Enhancing user experience on our website.') }}</li>
                    <li>{{ __('Complying with legal and regulatory obligations.') }}</li>
                </ul>

                <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('3. Data Protection') }}</h2>
                <p>{{ __('We are committed to safeguarding your information through appropriate security measures to prevent unauthorized access, alteration, disclosure, or destruction of your data.') }}</p>

                <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('4. Information Sharing') }}</h2>
                <p>{{ __('We do not sell, rent, or share your personal information with third parties, except in the following cases:') }}</p>
                <ul class="list-disc list-inside ml-4">
                    <li>{{ __('Service providers who assist us in website operations and order management (e.g., courier companies and payment platforms).') }}</li>
                    <li>{{ __('Compliance with legal obligations or government requests.') }}</li>
                </ul>

                <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('5. Cookies and Similar Technologies') }}</h2>
                <p>{{ __('Our website uses cookies to enhance user experience. You may configure your browser to reject cookies, though this may affect website functionality.') }}</p>

                <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('6. User Rights') }}</h2>
                <p>{{ __('You have the right to:') }}</p>
                <ul class="list-disc list-inside ml-4">
                    <li>{{ __('Access, rectify, or delete your personal data.') }}</li>
                    <li>{{ __('Restrict or object to the processing of your information.') }}</li>
                    <li>{{ __('Withdraw consent for data use at any time.') }}</li>
                </ul>
                <p>{{ __('To exercise these rights, contact us at') }} <span class="font-semibold">pescaderiasbenito@gmail.com</span>.</p>

                <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('7. Changes to the Privacy Policy') }}</h2>
                <p>{{ __('We reserve the right to modify this policy at any time. Any changes will be posted on this page with the corresponding update date.') }}</p>
                <p>{{ __('If you have questions about this policy, you may write to us at') }} <span class="font-semibold">pescaderiasbenito@gmail.com</span>.</p>

                <p class="mt-6 text-center font-semibold">{{ __('Benito\'s Fish Markets appreciates your trust.') }}</p>
            </div>
</x-app-layout>
