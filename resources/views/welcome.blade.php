<x-guest-layout>
<div class="container mx-auto px-6">
    <div class="mb-8 h-64 rounded-md overflow-hidden bg-cover bg-center shadow-lg" style="background-image: url('/slide/foto-makanan-hd.jpg')">
        <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
            <div class="px-10 max-w-3xl">
                <h2 class="text-3xl text-white font-semibold">{{ config('app.name', 'Restu Catering') }}</h2>
                <p class="mt-2 text-gray-200 text-shadow text-lg">Sebagai Platform Digital E-Catering Online, <b>{{ config('app.name', 'Restu Catering') }}</b> adalah platform dan media promosi untuk memasarkan catering dalam menjual produk atau jasanya dan memudahkan konsumen dalam mencari layanan.</p>
                <br>
                <a href="http://maps.google.com/?q=Jalan Kaswari, Way Hui, Kec. Jati Agung, Lampung Selatan" class="mt-2 text-gray-200 text-shadow text-lg">Jalan Kaswari, Way Hui, Kec. Jati Agung, Lampung Selatan</a>
                <br>
                <a href="https://wa.me/6282372868406" class="mt-2 text-gray-200 text-shadow text-lg">+62 823 7286 8406</a>
            </div>
        </div>
    </div>


    <div class="mt-16">
      <h3 class="text-gray-600 text-2xl font-medium">Jenis Aneka Menu</h3>
        <div class="flex flex-wrap justify-around mt-8">
          @foreach ($menus as $menu)
          <div class="w-5/12 h-36 rounded-md overflow-hidden mb-8 flex relative">
            @if (Auth::check())
              <button @click="cartOpen = true; cartApi('POST','{{route('cart.add',$menu->id).'?api_token='.Auth::user()->api_token}}')" class="absolute bottom-0 right-0 p-2 rounded-l-full hover:w-12 bg-emerald-600 text-white hover:bg-emerald-500 focus:outline-none focus:bg-emerlad-600 cursor-pointer">
                <x-svg.cart-logo />
              </button>
            @else
              <a href="{{route('login')}}" class="absolute bottom-0 right-0 p-2 rounded-l-full hover:w-12 bg-emerald-600 text-white hover:bg-emerald-500 focus:outline-none focus:bg-emerald-500 cursor-pointer">
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
