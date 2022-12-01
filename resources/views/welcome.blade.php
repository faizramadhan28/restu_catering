<x-guest-layout>
<div class="container mx-auto px-6">
    <div class="mb-8 h-64 rounded-md overflow-hidden bg-cover bg-center shadow-lg" style="background-image: url('/storage/img/jumbotron.jpg')">
        <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
            <div class="px-10 max-w-3xl">
                <h2 class="text-3xl text-white font-semibold">{{ config('app.name', 'Laravel') }}</h2>
                <p class="mt-2 text-gray-200 text-shadow text-lg">Sebagai Platform Digital E-Catering Online, <b>{{ config('app.name', 'Laravel') }}</b> adalah platform dan media promosi untuk memasarkan catering dalam menjual produk atau jasanya dan memudahkan konsumen dalam mencari layanan.</p>
                <br>
                <a href="http://maps.google.com/?q=Jalan Kaswari, Way Hui, Kec. Jati Agung, Lampung Selatan" class="mt-2 text-gray-200 text-shadow text-lg">Jalan Kaswari, Way Hui, Kec. Jati Agung, Lampung Selatan</a>
                <br>
                <a href="https://wa.me/6282372868406" class="mt-2 text-gray-200 text-shadow text-lg">+62 823 7286 8406</a>
            </div>
        </div>
    </div>
    
    <div id="indicators-carousel" class="relative" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
            <img src="{{asset('slide/foto-makanan.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{asset('slide/foto-makanan-hd.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{asset('slide/makanan-khas-Arab.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
  </div>
    
    <div class="mt-16">
      <h3 class="text-gray-600 text-2xl font-medium">Jenis Aneka Menu</h3>
        <div class="flex flex-wrap justify-around mt-8">
          @foreach ($menus as $menu)
          <div class="w-5/12 h-36 rounded-md overflow-hidden mb-8 flex relative">
            @if (Auth::check())
              <button @click="cartOpen = true; cartApi('POST','{{route('cart.add',$menu->id).'?api_token='.Auth::user()->api_token}}')" class="absolute bottom-0 right-0 p-2 rounded-l-full hover:w-12 bg-blue-600 text-white hover:bg-blue-500 focus:outline-none focus:bg-blue-500 cursor-pointer">
                <x-svg.cart-logo />
              </button>
            @else
              <a href="{{route('login')}}" class="absolute bottom-0 right-0 p-2 rounded-l-full hover:w-12 bg-blue-600 text-white hover:bg-blue-500 focus:outline-none focus:bg-blue-500 cursor-pointer">
                <x-svg.cart-logo />
              </a>
            @endif

            <img class="w-2/6" src="/storage/img/{{$menu->image}}" alt="">
            <div class="bg-white dark:bg-gray-800 h-full w-full px-5 py-3">
              <div class="w-9/12 overflow-ellipsis overflow-hidden text-gray-700 dark:text-gray-200">
                <a href="{{route('home.menu',$menu->id)}}" class="text-xs text-gray-700 dark:text-gray-200">{{$menu->menu}}</a>
                <h2 class="font-semibold text-gray-800 dark:text-gray-100 mt-5">Rp. {{$menu->harga}}</h2>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
</div>
</x-guest-layout>