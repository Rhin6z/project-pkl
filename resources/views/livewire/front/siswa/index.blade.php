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
      <div class="w-full bg-gradient-to-r from-emerald-600 to-emerald-500 p-6 text-center mb-4 rounded-lg">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <h1 class="text-2xl font-bold text-white tracking-wider">DAFTAR SISWA</h1>
        <p class="text-gray-200 mt-1">Sistem Informasi Jaringan dan Aplikasi</p>
      </div>
      {{-- Judul./ --}}

      {{-- Info User --}}
      <div class="bg-gray-800 p-4 rounded-lg mb-4 border border-gray-700">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm text-gray-300">
                Email pengguna: <span class="font-medium text-emerald-300">{{ $userMail }}</span>
            </p>
        </div>
      </div>
      {{-- ./Info User --}}
    {{-- Header Section with Stats and Search --}}
    <div class="mx-auto mb-6">
        {{-- Stats Cards Row --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2 gap-6 mb-6">
            <!-- Total Siswa Card -->
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Total Siswa</p>
                        <p class="text-3xl font-bold text-white">{{ number_format($stats['total_siswa']) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">👥</span>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-emerald-400 text-sm">↗️ Siswa Aktif</span>
                </div>
            </div>

            <!-- PKL Aktif -->
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Status Lapor PKL</p>
                        <p class="text-3xl font-bold text-emerald-400">{{ number_format($stats['status_lapor_pkl']) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">⚡</span>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-emerald-400 text-sm">🔥 Sedang Aktif</span>
                </div>
            </div>
        </div>

        {{-- Search and Filter Section --}}
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                {{-- Search Form --}}
                <div class="flex-1 max-w-md">
                    <label for="search" class="sr-only">Search students</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            wire:model.live="search"
                            type="text"
                            id="search"
                            name="search"
                            placeholder="Cari siswa..."
                            class="block w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                        >
                    </div>
                </div>

                {{-- Additional Actions (Optional) --}}
                <div class="flex items-center gap-3">
                    {{-- Filter Button --}}
                    <button class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-200 text-sm font-medium rounded-lg border border-gray-600 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

      {{-- ./Header Section with Stats and Search --}}

      {{-- Table Siswa --}}
      <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full bg-gray-800 divide-y divide-gray-700">
          <thead>
            <tr class="bg-gray-700">
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">No</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">NIS</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Gender</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Alamat</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Kontak</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status Lapor PKL</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-700">
            @foreach($siswas as $index => $siswa)
            <tr class="hover:bg-gray-700 transition duration-150 ease-in-out">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $index + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">{{ $siswa->nama }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $siswa->nis }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $siswa->gender }}</td>
              <td class="px-6 py-4 text-sm text-gray-300">{{ $siswa->alamat }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $siswa->kontak }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $siswa->email }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                @if($siswa->status_lapor_pkl == 1)
                  <span class="inline-flex items-center justify-center w-8 h-8 bg-emerald-900 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-300" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                  </span>
                @else
                  <span class="inline-flex items-center justify-center w-8 h-8 bg-red-900 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-300" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                  </span>
                @endif
              </td>
            </tr>
            @endforeach

            @if(count($siswas) == 0)
              <tr>
                <td colspan="8" class="px-6 py-10 text-center text-gray-400">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <p class="text-lg font-medium">Belum ada data siswa</p>
                  <p class="text-sm">Tidak ada data siswa yang ditemukan</p>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="p-6 bg-gray-800 border-t border-gray-700">
          {{ $siswas->links() }}
        </div>
      </div>
      {{-- ./Table Siswa --}}
  </div>
</div>
