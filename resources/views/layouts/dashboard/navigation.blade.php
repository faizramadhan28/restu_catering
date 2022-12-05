<nav x-data="{ open: false }" class="bg-emerald-600 dark:bg-gray-800">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 my-5">
        <a href="{{route('home')}}" class="w-full text-gray-300 dark:text-white md:text-center text-sm font-semibold cursor-pointer flex items-center">
            <img src="{{asset('logo/namalogo.png')}}" class="block h-10 w-auto fill-current text-gray-600 text-wrap" />
        </a>
    </div>

    <div>

        <div class="pt-4 pb-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="whitespace-nowrap">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('order.index')" :active="request()->routeIs('order.index')" class="whitespace-nowrap">
                {{ __('Pesanan Masuk') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('ordersubs.index')" :active="request()->routeIs('ordersubs.index')" class="whitespace-nowrap">
                {{ __('Pesanan Masuk Langganan') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')" class="whitespace-nowrap">
                {{ __('Katalog Menu') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('langganan.index')" :active="request()->routeIs('langganan.index')" class="whitespace-nowrap">
                {{ __(' Katalog Menu Langganan') }}
            </x-responsive-nav-link>
        </div>


        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('admin.report')" :active="request()->routeIs('admin.report')" class="whitespace-nowrap">
                {{ __('Laporan Keuangan') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3">
            <x-responsive-nav-link :href="route('kas.index')" :active="request()->routeIs('kas.index')" class="whitespace-nowrap">
                {{ __('Laporan Kas Keluar') }}
            </x-responsive-nav-link>
        </div>

    </div>
</nav>
