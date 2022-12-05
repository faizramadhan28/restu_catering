<div x-data="{
      qty:{{$cart->qty}},
      subsApi(method,url) {
          fetch(url,{method:method,headers:{Accept:'application/json'}}).then(async (result) => {
              if (result.status == 200) return await result.json()
          }).then(async (result) => this.qty = result).catch((err) => console.log(err));
      }
  }" class="flex justify-between mt-6" x-show="qty > 0">
      <div class="flex">
          <img class="h-20 w-20 object-cover rounded" src="/storage/img/{{$langganan->image}}" alt="">
          <div class="mx-3">
              <h3 class="text-sm text-gray-600 dark:text-gray-200">{{$langganan->menu}}</h3>
              <div class="flex items-center mt-2">
                  <button class="text-gray-500 dark:text-gray-300 focus:outline-none focus:text-gray-600" @click="subsApi('PUT','{{route('cartsubs.more',$langganan->id).'?api_token='.Auth::user()->api_token}}')">
                      <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </button>
                  <span class="text-gray-700 dark:text-gray-100 mx-2" x-text="qty"></span>
                  <button class="text-gray-500 dark:text-gray-300 focus:outline-none focus:text-gray-600" @click="subsApi('DELETE','{{route('cartsubs.less',$langganan->id).'?api_token='.Auth::user()->api_token}}')" >
                      <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </button>
              </div>
          </div>
      </div>
      <span class="text-gray-600 whitespace-nowrap" >Rp. {{$langganan->harga}}</span>
</div>