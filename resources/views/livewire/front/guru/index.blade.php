<div class="min-h-screen">
    <!-- Header Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-12 rounded-3xl mb-8">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">👨‍🏫 Teachers Directory</h1>
                    <p class="text-emerald-100 text-lg">Discover our amazing teaching staff</p>
                    <p class="text-emerald-200 mt-2">Connect with mentors who shape the future</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <div class="text-6xl">🎓</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-400 rounded-full opacity-10 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-300 rounded-full opacity-10 animate-pulse delay-1000"></div>
        </div>
    </div>

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
                            placeholder="Search teachers by name, NIP, or email..."
                            class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl pl-10 pr-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                        >
                    </div>

                    <!-- Gender Filter -->
                    <div class="relative">
                        <select
                            wire:model.live="gender"
                            class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 appearance-none"
                        >
                            <option value="">All Genders</option>
                            <option value="L">Male</option>
                            <option value="P">Female</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Teachers Grid -->
    <div class="px-6 pb-8">
        <div class="mx-auto max-w-7xl">
            @if($gurus->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach($gurus as $guru)
                        <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 group">
                            <!-- Avatar -->
                            <div class="flex justify-center mb-4">
                                <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                    {{ strtoupper(substr($guru->nama, 0, 2)) }}
                                </div>
                            </div>

                            <!-- Teacher Info -->
                            <div class="text-center space-y-2">
                                <h3 class="text-lg font-bold text-white group-hover:text-emerald-400 transition-colors duration-200">
                                    {{ $guru->nama }}
                                </h3>

                                <div class="flex items-center justify-center space-x-2 text-gray-400">
                                    <span class="text-sm">🆔</span>
                                    <span class="text-sm">{{ $guru->nip }}</span>
                                </div>

                                <div class="flex items-center justify-center space-x-2 text-gray-400">
                                    <span class="text-sm">{{ $guru->gender === 'L' ? '👨' : '👩' }}</span>
                                    <span class="text-sm">{{ $guru->gender === 'L' ? 'Male' : 'Female' }}</span>
                                </div>

                                @if($guru->email)
                                    <div class="flex items-center justify-center space-x-2 text-gray-400">
                                        <span class="text-sm">📧</span>
                                        <span class="text-sm truncate">{{ $guru->email }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- PKL Count -->
                            <div class="mt-4 pt-4 border-t border-gray-700">
                                <div class="flex items-center justify-center space-x-2">
                                    <span class="text-emerald-400">📚</span>
                                    <span class="text-emerald-400 text-sm font-medium">
                                        {{ $guru->pkls->count() }} PKL Programs
                                    </span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $gurus->links('pagination::tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-12 text-center">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-xl font-bold text-white mb-2">No Teachers Found</h3>
                    <p class="text-gray-400 mb-4">
                        @if($search || $gender)
                            Try adjusting your search filters or check back later.
                        @else
                            No teachers have been added to the system yet.
                        @endif
                    </p>
                    @if($search || $gender)
                        <button
                            wire:click="$set('search', '')"
                            wire:click="$set('gender', '')"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 hover:scale-105"
                        >
                            🔄 Clear Filters
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
