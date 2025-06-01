<div class="min-h-screen">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-12 rounded-3xl mb-8">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">🏢 Mitra Industri SIJA</h1>
                    <p class="text-emerald-200 mt-2">Tempat siswa PKL untuk mencari pengalaman kerja</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <div class="text-6xl">🤝</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-400 rounded-full opacity-10 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-300 rounded-full opacity-10 animate-pulse delay-1000"></div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="px-6 mb-4">
            <div class="mx-auto max-w-7xl">
                <div class="bg-emerald-500 bg-opacity-20 border border-emerald-500 border-opacity-30 rounded-2xl p-4">
                    <div class="flex items-center">
                        <div class="text-emerald-400 mr-3 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-white font-medium">{{ session('message') }}</div>
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
                        <div class="text-red-400 mr-3 flex-shrink-0">
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

    <!-- Search & Filter Section -->
    <div class="px-6 mb-8">
        <div class="mx-auto max-w-7xl">
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Search dengan nama industri atau bidang usaha"
                            class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl pl-10 pr-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                        >
                    </div>

                    <!-- Add Industry Button -->
                    <div class="flex items-center justify-end">
                        <button
                            wire:click="create()"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl transition duration-300 ease-in-out flex items-center font-medium hover:scale-105"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Industri
                        </button>
                    </div>
                </div>

                <!-- Active Filters Display -->
                @if($search || $bidang_usaha)
                    <div class="mt-4 pt-4 border-t border-gray-700">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-gray-400 text-sm">Active filters:</span>

                            @if($search)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500 bg-opacity-20 text-emerald-400 border border-emerald-500 border-opacity-30">
                                    Search: "{{ $search }}"
                                    <button wire:click="$set('search', '')" class="ml-2 text-emerald-400 hover:text-emerald-300">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                            @endif

                            @if($bidang_usaha)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-500 bg-opacity-20 text-purple-400 border border-purple-500 border-opacity-30">
                                    Field: {{ $bidang_usaha }}
                                    <button wire:click="$set('bidang_usaha', '')" class="ml-2 text-purple-400 hover:text-purple-300">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                            @endif

                            <button
                                wire:click="clearFilters()"
                                class="text-gray-400 hover:text-white text-xs underline"
                            >
                                Clear all
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Create Industri -->
    @if($isOpen)
        @include('livewire.front.industri.create')
    @endif

    <!-- Industries Grid -->
    <div class="px-6 pb-8">
        <div class="mx-auto max-w-7xl">
            @if($industris && $industris->count() > 0)
                <!-- Results Counter -->
                <div class="mb-6">
                    <p class="text-gray-400 text-sm">
                        Menampilkan {{ $industris->count() }} dari {{ $industris->total() }} mitra industri
                        @if($search || $bidang_usaha)
                            matching your filters
                        @endif
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($industris as $industri)
                        <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 group">
                            <!-- Company Logo/Avatar -->
                            <div class="flex justify-center mb-4">
                                <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    {{ strtoupper(substr($industri->nama ?? '', 0, 2)) }}
                                </div>
                            </div>

                            <!-- Company Info -->
                            <div class="space-y-3">
                                <div class="text-center">
                                    <h3 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors duration-200 mb-2">
                                        {{ $industri->nama ?? 'Unknown Company' }}
                                    </h3>

                                    <!-- Business Field Badge -->
                                    @if($industri->bidang_usaha)
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500 bg-opacity-20 text-white border border-emerald-500 border-opacity-30">
                                            🏭 {{ $industri->bidang_usaha }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Address -->
                                @if($industri->alamat)
                                    <div class="flex items-start space-x-2 text-gray-400">
                                        <span class="text-sm mt-0.5 flex-shrink-0">📍</span>
                                        <span class="text-sm leading-relaxed">{{ $industri->alamat }}</span>
                                    </div>
                                @endif

                                <!-- Contact Info -->
                                <div class="space-y-2">
                                    @if($industri->kontak)
                                        <div class="flex items-center space-x-2 text-gray-400">
                                            <span class="text-sm flex-shrink-0">📞</span>
                                            <span class="text-sm">{{ $industri->kontak }}</span>
                                        </div>
                                    @endif

                                    @if($industri->email)
                                        <div class="flex items-center space-x-2 text-gray-400">
                                            <span class="text-sm flex-shrink-0">📧</span>
                                            <a href="mailto:{{ $industri->email }}" class="text-sm text-emerald-400 hover:text-emerald-300 transition-colors duration-200 truncate">
                                                {{ $industri->email }}
                                            </a>
                                        </div>
                                    @endif

                                    @if($industri->website)
                                        <div class="flex items-center space-x-2 text-gray-400">
                                            <span class="text-sm flex-shrink-0">🌐</span>
                                            <a href="{{ $industri->website }}" target="_blank" rel="noopener noreferrer" class="text-sm text-emerald-400 hover:text-emerald-300 transition-colors duration-200 truncate">
                                                {{ str_replace(['https://', 'http://'], '', $industri->website) }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- PKL Count -->
                            <div class="mt-4 pt-4 border-t border-gray-700">
                                <div class="flex items-center justify-center space-x-2">
                                    <span class="text-purple-400">👥</span>
                                    <span class="text-purple-400 text-sm font-medium">
                                        {{ $industri->pkls ? $industri->pkls->count() : 0 }} Siswa PKL Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $industris->links('pagination::tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-12 text-center">
                    <div class="text-6xl mb-4">🏢</div>
                    <h3 class="text-xl font-bold text-white mb-2">No Industries Found</h3>
                    <p class="text-gray-400 mb-6">
                        @if($search || $bidang_usaha)
                            No industry partners match your current search criteria.
                        @else
                            No industry partners have been added to the system yet.
                        @endif
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        @if($search || $bidang_usaha)
                            <button
                                wire:click="clearFilters()"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 hover:scale-105 inline-flex items-center"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Clear Filters
                            </button>
                        @endif
                        <button
                            wire:click="create()"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 hover:scale-105 inline-flex items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add First Industry
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
