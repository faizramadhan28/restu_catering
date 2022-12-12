<header class="bg-emerald-600 dark:bg-gray-800 shadow-lg">
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-evenly">
            <div class="hidden w-full text-gray-300 md:flex md:items-center">
                <x-switch-theme class="mr-10" />
            </div>
            <a href="{{ route('home') }}"
                class="ml-7 w-full text-gray-200 dark:text-white md:text-center text-sm font-semibold cursor-pointer flex items-center">
                <img src="{{ asset('logo/namalogo.png') }}" class="w-48 h-24" />
            </a>
            <div class="flex items-center justify-end w-full">
                <div class="flex justify-between">
                    <a href="{{route('langganan')}}" class="ml-7 text-gray-200 dark:text-white md:text-center text-sm font-semibold cursor-pointer flex items-center">
                        Langganan
                    </a>

                    @if (Auth::check())
                        <button @click="cartOpen = !cartOpen"
                            class="text-gray-200 dark:text-white focus:outline-none mx-4">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </button>


                        <x-dropdown class="mr-5" align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-200 hover:text-gray-100 hover:border-gray-300 dark:hover:text-gray-200 dark:hover:border-gray-200 focus:outline-none transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @role('admin')
                                    <x-dropdown-link :href="route('dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link :href="route('profile')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('home.order')">
                            {{ __('Pesanan') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('subs.order')">
                            {{ __('Berlangganan') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        </x-slot>
                        </x-dropdown>
                    @else
                        <x-nav-link class="bg-emerald-600 hover:bg-emerald-500" :href="route('login')">
                            {{ __('Login') }}
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </x-nav-link>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </header>
