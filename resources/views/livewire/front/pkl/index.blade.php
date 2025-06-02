@php
use Carbon\Carbon;
@endphp

<div class="min-h-screen">
    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-12 rounded-3xl mb-8">
        <div class="mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">📋 Laporan Siswa PKL</h1>
                    <p class="text-emerald-200 mt-2">Sistem Informasi Jaringan dan Aplikasi</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <div class="text-6xl">👨‍🎓</div>
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

    <!-- Search & Filter Section -->
    <div class="px-6 mb-8">
        <div class="mx-auto max-w-7xl">
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Cari laporan PKL..."
                            class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl pl-10 pr-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        >
                    </div>

                    <!-- Add PKL Button -->
                    <div class="flex items-center justify-end">
                        <button
                            wire:click="create()"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl transition duration-300 flex items-center font-medium"
                        >
                            <svg class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Laporan PKL
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

    <!-- Modal Create PKL -->
    @if($isOpen)
        @include('livewire.front.pkl.create')
    @endif

    <!-- PKL Table -->
    <div class="px-6 pb-8">
        <div class="mx-auto max-w-7xl">
            @if($pkls && $pkls->count() > 0)
                <!-- Results Counter -->
                <div class="mb-6">
                    <p class="text-gray-400 text-sm">
                        Menampilkan {{ $pkls->firstItem() ?? 0 }} - {{ $pkls->lastItem() ?? 0 }} dari {{ $pkls->total() }} laporan PKL
                    </p>
                </div>

                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl overflow-hidden mb-8">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-900 bg-opacity-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Siswa</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Industri</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Guru Pembimbing</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Periode</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($pkls as $pkl)
                                    @php
                                        $today = Carbon::now();
                                        $mulai = Carbon::parse($pkl->mulai);
                                        $selesai = Carbon::parse($pkl->selesai);
                                        $durasi = $mulai->diffInDays($selesai);

                                        if ($today->between($mulai, $selesai)) {
                                            $statusText = 'Sedang Berjalan';
                                            $statusClass = 'bg-green-500 bg-opacity-20 text-white';
                                            $statusIcon = '⚡';
                                        } elseif ($today->gt($selesai)) {
                                            $statusText = 'Selesai';
                                            $statusClass = 'bg-blue-500 bg-opacity-20 text-white';
                                            $statusIcon = '✅';
                                        } else {
                                            $statusText = 'Akan Datang';
                                            $statusClass = 'bg-yellow-500 bg-opacity-20 text-white';
                                            $statusIcon = '⏰';
                                        }
                                    @endphp

                                    <tr class="hover:bg-gray-700 hover:bg-opacity-30 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center text-white text-sm font-bold">
                                                    {{ strtoupper(substr($pkl->siswa->nama ?? '', 0, 2)) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-white">{{ $pkl->siswa->nama ?? '-' }}</div>
                                                    <div class="text-xs text-gray-400">NIS: {{ $pkl->siswa->nis ?? '-' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-white font-medium">{{ $pkl->industri->nama ?? '-' }}</div>
                                            <div class="text-xs text-gray-400">{{ Str::limit($pkl->industri->alamat ?? '', 40) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-white font-medium">{{ $pkl->guru->nama ?? '-' }}</div>
                                            <div class="text-xs text-gray-400">{{ $pkl->guru->email ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-white">{{ Carbon::parse($pkl->mulai)->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-400">s/d {{ Carbon::parse($pkl->selesai)->format('d M Y') }}</div>
                                            <div class="text-xs text-purple-400 font-medium">{{ $durasi }} hari</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                                {{ $statusIcon }} {{ $statusText }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button wire:click="confirmDelete({{ $pkl->id }})" class="text-red-400 hover:text-red-300 transition-colors p-2 rounded-lg hover:bg-gray-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $pkls->links('pagination::tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-12 text-center">
                    <div class="text-6xl mb-4">📋</div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Laporan PKL</h3>
                    <p class="text-gray-400 mb-6">
                        @if($search)
                            Tidak ada laporan PKL yang sesuai dengan pencarian Anda.
                        @else
                            Belum ada data laporan PKL yang ditambahkan ke sistem.
                        @endif
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        @if($search)
                            <button wire:click="$set('search', '')" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-medium transition-all">
                                Clear Filters
                            </button>
                        @endif
                        <button wire:click="create()" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all">
                            Tambah Laporan PKL Pertama
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if($confirmingDeletion)
        <div class="fixed inset-0 z-40 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                <div class="fixed inset-0 bg-gray-900 opacity-50"></div>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gray-800 rounded-2xl shadow-xl border border-gray-700 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="py-5 px-6">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-white">Konfirmasi Hapus</h2>
                            <button wire:click="cancelDelete()" class="text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="border-t border-gray-700 my-3"></div>

                        <div class="flex items-center justify-center mb-4">
                            <div class="w-16 h-16 bg-red-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                        </div>

                        <p class="text-gray-300 text-center mb-6">
                            Apakah Anda yakin ingin menghapus data PKL ini?
                            <br><span class="text-red-400 font-medium">Tindakan ini tidak dapat dibatalkan.</span>
                        </p>
                    </div>

                    <div class="px-6 py-4 bg-gray-900 bg-opacity-50 border-t border-gray-700 sm:flex sm:flex-row-reverse">
                        <button wire:click="delete()" class="w-full sm:w-auto sm:ml-3 mb-3 sm:mb-0 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition duration-300 flex items-center justify-center">
                            Ya, Hapus
                        </button>
                        <button wire:click="cancelDelete()" class="w-full sm:w-auto px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-200 font-medium rounded-xl transition duration-300">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
