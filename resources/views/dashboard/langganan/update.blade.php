<x-app-layout>
  <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
      <div class="mx-auto sm:px-6 lg:px-8">
          <div class="py-4">
              <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                  <span>{{ __($title) }}</span>
              </div>

              <!-- Validation Errors -->
              <x-validation-errors class="mb-4 sm:px-6 lg:px-8" :errors="$errors" />

              <div class="mx-auto sm:px-6 lg:px-8 h-screen container">

                <form method="POST" action="{{ route('langganan.update', $langganan->id) }}" enctype="multipart/form-data">
                  <div class="flex justify-between">
                    <div class="w-5/12 mx-5">
                      @method('PATCH')
                      @csrf

                      <div class="mb-10 pr-10">
                        <x-forms.upload-image :identifier="'imageLangganan'" :urlFile="'/storage/img/'.$langganan->image" />                    
                      </div>
                    </div>
                    <div class="w-7/12 mx-5">
                      <div class="mb-10">
                        <x-forms.label for="menu" :value="__('Nama Menu Langganan')" />
                        <x-forms.input id="menu" class="block mt-1 w-full text-gray-900" type="text" name="menu" :value="old('menu') ?? $langganan->menu" required autofocus />
                      </div>
  
                      <div class="mb-10">
                        <x-forms.label for="harga" :value="__('Harga Menu')" />
                        <x-forms.input id="harga" class="block mt-1 w-full text-gray-900" type="number" name="harga" :value="old('harga') ?? $langganan->harga" required />
                      </div>

                      <div class="mb-10">
                        <x-forms.label for="durasi" :value="__('Durasi')" />
                        <x-forms.input id="durasi" class="block mt-1 w-full text-gray-900" type="text" name="durasi" :value="old('durasi') ?? $langganan->durasi" required />
                      </div>

                      <div class="mb-10">
                        <x-forms.label for="desc" :value="__('Deskripsi')" />
                        <x-forms.textarea id="desc" class="block mt-1 w-full text-gray-900 h-36" type="text" name="desc" required>{{$langganan->desc}}</x-forms.textarea>
                      </div>

                      
  
                      <div class="w-full flex justify-end">
                        <x-button :color="'bg-blue-600'">
                          {{ __('Tambah') }}
                        </x-button>
                      </div>
                    </div>
  
                  </div>
                </form>

              </div>
          </div>
      </div>
  </div>
</x-app-layout>
