<x-site-layout>
    <x-slot name="header">{{ __('Register') }}</x-slot>

    <div class="min-h-75vh flex items-center justify-center bg-gray-50 dark:bg-dark-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <x-status />

            <div class="card">
                <div class="card-body p-4 md:p-10">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-light-100">
                            {{ __('Create Your Account') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            {{ __('Start your journey with us') }}
                        </p>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="space-y-4">
                            <x-form.input name="name" type="text" id="name" :label="__('Full Name')" required
                                autofocus
                                class="focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-600 dark:border-dark-500" />

                            <x-form.input name="email" type="email" id="email" :label="__('Email Address')" required
                                class="focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-600 dark:border-dark-500" />

                            <x-form.input name="password" type="password" id="password" :label="__('Password')" required
                                class="focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-600 dark:border-dark-500" />

                            <x-form.input name="password_confirmation" type="password" id="password_confirmation"
                                :label="__('Confirm Password')" required
                                class="focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-600 dark:border-dark-500" />
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox"
                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded dark:bg-dark-600 dark:border-dark-500"
                                required>
                            <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                {{ __('I agree to the') }}
                                <a href="#"
                                    class="text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                                    {{ __('terms and conditions') }}
                                </a>
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-dark-700">
                            {{ __('Create Account') }}
                        </button>
                    </form>
                </div>

                <div class="bg-gray-50 dark:bg-dark-600 px-10 py-6 rounded-b-xl">
                    <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}"
                            class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                            {{ __('Sign in here') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
