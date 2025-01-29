<x-site-layout>
    <x-slot name="header">{{ __('Log in') }}</x-slot>

    <div class="min-h-75vh flex items-center justify-center bg-gray-50 dark:bg-dark-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <x-status />

            <div class="card">
                <div class="card-body p-4 md:p-10">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-primary">
                            {{ __('Welcome Back') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            {{ __('Sign in to your account') }}
                        </p>
                    </div>

                    <form class="space-y-6" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-4">
                            <x-form.input name="email" id="email" :label="__('Email address')" autofocus :value="old('email')" />

                            <x-form.input name="password" type="password" id="password" :label="__('Password')"
                                :value="old('password', '')" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded dark:bg-dark-600 dark:border-dark-500">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('Remember me') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}"
                                        class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                                        {{ __('Forgot password?') }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn primary gradient w-full">
                            {{ __('Sign in') }}
                        </button>
                    </form>
                </div>

                @if (Route::has('register'))
                    <div class="bg-gray-50 dark:bg-dark-600 px-10 py-6 rounded-b-xl">
                        <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}"
                                class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300">
                                {{ __('Sign up') }}
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-site-layout>
