<div class="py-12 min-h-screen">
  <div class="mx-auto px-4 sm:px-6 lg:px-8">

      {{-- tampilan pesan --}}
      <div class="p-4">
        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="p-4 bg-red-600 bg-opacity-80 text-white rounded-lg shadow-md flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="p-4 bg-green-600 bg-opacity-80 text-white rounded-lg shadow-md flex items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
      </div>
      {{-- ./tampilan pesan --}}

      {{-- Judul --}}
      <div class="w-full bg-gradient-to-r from-gray-700 to-emerald-800 p-6 text-center mb-4 rounded-lg">
        <h1 class="text-2xl font-bold text-white tracking-wider">LAPORAN SISWA PKL</h1>
        <p class="text-gray-200 mt-1">Sistem Informasi Jaringan dan Aplikasi</p>
      </div>
      {{-- Judul./ --}}

      {{-- Form Entry dan Searching --}}
      <div class="mx-auto flex flex-col md:flex-row md:items-center md:justify-between p-6 mb-4">
          <div class="mb-4 md:mb-0">
              <button wire:click="create()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg transition duration-300 ease-in-out flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                  </svg>
                  Tambah Laporan PKL
              </button>
          </div>

          {{-- cek apakah menampilkan halaman modal --}}
          @if($isOpen)
              @include('livewire.front.pkl.create')
          @endif
          {{-- ./cek apakah menampilkan halaman modal --}}

          {{-- form searching --}}
          <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                  </svg>
              </div>
              <input wire:model.live="search" type="text" placeholder="Cari laporan..." class="pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 w-full">
          </div>
          {{-- ./form searching --}}
      </div>
      {{-- ./Form Entry dan Searching --}}

      {{-- Table PKL --}}
      <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full bg-gray-800 divide-y divide-gray-700">
          <thead>
            <tr class="bg-gray-700">
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">No</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama Siswa</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Industri</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Bidang Usaha</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Mulai</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Selesai</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Durasi (Hari)</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-700">
            @php
              use Carbon\Carbon;
              $no = 0;
            @endphp

            @foreach($pkls as $key => $pkl)
              @php
                $no++;
                $d1 = Carbon::parse($pkl->mulai);
                $d2 = Carbon::parse($pkl->selesai);
                $selisihHari = $d1->diffInDays($d2); // Selisih dalam hari
              @endphp

              <tr class="hover:bg-gray-700 transition duration-150 ease-in-out">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $no }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">{{ $pkl->siswa->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $pkl->industri->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $pkl->industri->bidang_usaha }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $pkl->mulai }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $pkl->selesai }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                  <span class="px-3 py-1 bg-emerald-900 text-emerald-200 rounded-full">
                    {{ $selisihHari }} hari
                  </span>
                </td>
              </tr>
            @endforeach

            @if(count($pkls) == 0)
              <tr>
                <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <p class="text-lg font-medium">Belum ada data laporan PKL</p>
                  <p class="text-sm">Silakan tambah data baru dengan menekan tombol "Tambah Laporan PKL"</p>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
            <div class="p-6 bg-gray-800 border-t border-gray-700">
                {{ $pkls->links() }}
            </div>
      </div>
      {{-- ./Table PKL --}}
    </div>
    {{-- ./Card --}}
  </div>
</div>
