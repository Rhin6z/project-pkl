@php
use Carbon\Carbon;
@endphp

<div class="min-h-screen">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-12 rounded-3xl mb-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">👥 Daftar Siswa</h1>
                    <p class="text-emerald-200 mt-2">Sistem Informasi Jaringan dan Aplikasi</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <div class="text-6xl">🎓</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="px-6 mb-4">
            <div class="mx-auto max-w-7xl">
                <div class="bg-emerald-500 bg-opacity-20 border border-emerald-500 border-opacity-30 rounded-2xl p-4">
                    <div class="flex items-center">
                        <div class="text-emerald-400 mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-white font-medium">{{ session('success') }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="px-6 mb-4">
            <div class="mx-auto max-w-7xl">
                <div class="bg-red-500 bg-opacity-20 border border-red-500 border-opacity-30 rounded-2xl p-4">
                    <div class="flex items-center">
                        <div class="text-red-400 mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-white font-medium">{{ session('error') }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- User Info -->
    <div class="px-6 mb-6">
        <div class="mx-auto max-w-7xl">
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-4">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-emerald-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm text-gray-300">
                        Email pengguna: <span class="font-medium text-emerald-300">{{ $userMail }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="px-6 mb-6">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                        <span class="text-emerald-400 text-sm">👨‍🎓 Siswa Aktif</span>
                    </div>
                </div>

                <!-- PKL Aktif Card -->
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
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="px-6 mb-8">
        <div class="mx-auto max-w-7xl">
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search Input -->
                    <div class="relative md:col-span-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Cari siswa berdasarkan nama, NIS, atau email..."
                            class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl pl-10 pr-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >
                    </div>

                    <!-- Filter Actions -->
                    <div class="flex items-center justify-end space-x-2">
                        <button class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-4 py-3 rounded-xl transition duration-300 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Active Filters Display -->
                @if($search)
                    <div class="mt-4 pt-4 border-t border-gray-700">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-gray-400 text-sm">Active filters:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500 bg-opacity-20 text-emerald-400 border border-emerald-500 border-opacity-30">
                                Search: "{{ $search }}"
                                <button wire:click="$set('search', '')" class="ml-2 text-emerald-400 hover:text-emerald-300">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </span>
                            <button wire:click="$set('search', '')" class="text-gray-400 hover:text-white text-xs underline">
                                Clear all
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="px-6 pb-8">
        <div class="mx-auto max-w-7xl">
            @if($siswas && $siswas->count() > 0)
                <!-- Results Counter -->
                <div class="mb-6">
                    <p class="text-gray-400 text-sm">
                        Menampilkan {{ $siswas->firstItem() ?? 0 }} - {{ $siswas->lastItem() ?? 0 }} dari {{ $siswas->total() }} siswa
                    </p>
                </div>

                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl overflow-hidden mb-8">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-900 bg-opacity-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Siswa</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">NIS</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Gender</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Kontak</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status PKL</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($siswas as $siswa)
                                    @php
                                        // Using the gender function from database
                                        $genderText = DB::select("SELECT getGenderCode(?) as gender", [$siswa->gender])[0]->gender ?? 'Tidak diketahui';
                                        $genderColor = $siswa->gender === 'L' ? 'from-blue-400 to-blue-600' : ($siswa->gender === 'P' ? 'from-pink-400 to-pink-600' : 'from-gray-400 to-gray-600');
                                    @endphp

                                    <tr class="hover:bg-gray-700 hover:bg-opacity-30 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br {{ $genderColor }} rounded-lg flex items-center justify-center text-white text-sm font-bold">
                                                    {{ strtoupper(substr($siswa->nama, 0, 2)) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-white">{{ $siswa->nama }}</div>
                                                    <div class="text-xs text-gray-400">{{ $siswa->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-mono text-white bg-emerald-500 bg-opacity-10 px-2 py-1 rounded-lg inline-block">
                                                {{ $siswa->nis }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm font-medium text-white">{{ $genderText }}</div>
                                                    <div class="text-xs text-gray-400">{{ $siswa->gender }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-white">{{ $siswa->kontak }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-300 max-w-xs">
                                                {{ Str::limit($siswa->alamat, 50) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($siswa->status_lapor_pkl == 1)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500 bg-opacity-20 text-white border border-emerald-500 border-opacity-30">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Aktif PKL
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-500 bg-opacity-20 text-gray-400 border border-gray-500 border-opacity-30">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                    Belum PKL
                                                </span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $siswas->links('pagination::tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-12 text-center">
                    <div class="text-6xl mb-4">👥</div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data Siswa</h3>
                    <p class="text-gray-400 mb-6">
                        @if($search)
                            Tidak ada siswa yang sesuai dengan pencarian Anda.
                        @else
                            Belum ada data siswa yang ditambahkan ke sistem.
                        @endif
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        @if($search)
                            <button wire:click="$set('search', '')" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-medium transition-all">
                                Clear Filters
                            </button>
                        @endif
                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all">
                            Tambah Siswa Baru
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
