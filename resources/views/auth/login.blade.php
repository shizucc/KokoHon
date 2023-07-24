<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div style="display: flex; justify-content: center; align-items: center;margin: 0;">
            <div style="text-align: center; display: flex; flex-direction: column;">

                <img src="{{asset('storage/images/icon/book-stack.png')}}" style="width: 150px; height:150px; object-fit:cover" alt="kokohon_img">
                <div style="margin-top:5px">
                    <p class="text-3xl font-medium text-gray-900 dark:text-white">Koko<span class="text-3xl font-bold text-blue-600 dark:text-white">Hon</span></p>
                </div>
            </div>
        </div>
        <div class="mb-4">
                <label for="email" style="margin-bottom: 5px" class="block mb-2  text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input name="email" value="{{old('email')}}" type="email" id="email" required autofocus class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="mb-2">
                <label for="password" style="margin-bottom: 5px" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Remember Me -->

        <div class="flex items-center justify-end mt-4">
            <div style="margin-right: 5px">
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            </div>
            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
