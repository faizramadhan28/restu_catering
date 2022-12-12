<x-app-layout>
    <div class="py-12 bg-gray-200 dark:bg-gray-900 min-h-screen">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <div class="text-2xl mb-14 leading-7 font-semibold text-gray-900 dark:text-white mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-between items-center">
                    <span>{{ __($title) }}</span>
                    <x-nav-link class="ml-3 bg-blue-600 hover:bg-blue-500" :href="route('kas.create')" :active="request()->routeIs('kas.create')">
                        {{ __('Tambah Data Kas') }}
                    </x-nav-link>
                </div>
                <div>
                    <x-nav-link :href="route('kas.export')" class="whitespace-nowrap bg-blue-600" target="_blank">
                        {{ __('Export Excel') }}
                    </x-nav-link>
                </div>

                <!-- Session Status -->
                <x-session-status class="mb-4 border-4 border-blue-800 rounded-lg p-3" :status="session('status')" />

                <!-- Validation Errors -->
                <x-validation-errors class="mb-4 border-4 border-red-800 rounded-lg p-3" :errors="$errors" />

                <div class="mx-auto flex flex-wrap justify-between">

                    <table x-data="{totalPendapatan : 0}" class="shadow-xl" id="datatable">
                        <thead class="dark:bg-gray-300 bg-gray-600">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    Nama Transaksi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    Tanggal Transaksi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    Foto
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold">
                                    Uang Keluar
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium text-gray-100 dark:text-gray-500 uppercase tracking-wider font-bold text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 dark:bg-gray-800">
                        @foreach ($kas as $key => $item)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-wrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ ++$key }}</div>
                                </td>
                                <td class="px-6 py-4 text-wrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $item->nama_transaksi }}</div>
                                        </td>
                                <td class="px-6 py-4 text-wrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $item->tgl_transaksi }}</div>
                                        </td>

                                <td class="px-6 py-4 text-wrap">
                                            <img src="/storage/kas/{{ $item->foto }}" class="h-48 w-48">
                                        </td>
                                <td class="px-6 py-4 text-wrap">
                                  <div class="text-sm text-gray-900 dark:text-gray-300 text-right" x-data={} x-init="$nextTick(() => $parent.totalPendapatan = $parent.totalPendapatan + {{ $item->uang_keluar }})"> Rp. {{ $item->uang_keluar }}</div>
                                </td>


                                        <td class="px-6 py-4 text-wrap">
                                            <x-dropdown align="right" width="48">
                                                <x-slot name="trigger">
                                                    <button
                                                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                                </svg>
                                                        </div>
                                                    </button>
                                                </x-slot>

                                                <x-slot name="content">
                                                    <x-dropdown-link :href="route('kas.edit', $item->id)">
                                                        {{ __('Edit') }}
                                                    </x-dropdown-link>
                                                    <form method="POST" action="{{ route('kas.destroy', $item->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <x-dropdown-link :href="route('kas.destroy', $item->id)"
                                                            onclick="myFunction()" id="target">
                                                            {{ __('Hapus') }}
                                                        </x-dropdown-link>
                                                    </form>
                                                </x-slot>
                                            </x-dropdown>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                        <tfoot class="dark:bg-gray-300 bg-gray-600">
                            <tr class="text-gray-100 dark:text-gray-500">
                                <th colspan="5" scope="col"
                                    class="px-6 py-3 text-left text-xs leading-7 font-medium uppercase tracking-wider font-bold">
                                    Total Pengeluaran
                                </th>
                                <th class="px-6 py-4 text-wrap text-right text-sm" x-text="'Rp. ' + totalPendapatan">
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @push('after-script')
    <script>
        function myFunction(){
            if (confirm("Apakah anda yakin?")==true){
                event.preventDefault();
                $('#target').closest('form').submit();
            }
        }
    </script>
    @endpush
</x-app-layout>
