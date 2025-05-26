<div class="min-h-screen">
    <!-- Header Welcome Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 to-emerald-500 px-6 py-12 rounded-3xl">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">{{ $greeting }}, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-emerald-100 text-lg">{{ $currentTime }}</p>
                    <p class="text-emerald-200 mt-2">Ready to manage your PKL activities today?</p>
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

    <!-- Stats Cards Section -->
    <div class="px-6 py-8">
        <div class="mx-auto max-w-7xl">
            <h2 class="text-2xl font-bold text-white mb-6">📊 Dashboard Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Siswa -->
                <a href="{{ route('siswa') }}" class="block group">
                    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 cursor-pointer group-hover:border-emerald-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Students</p>
                                <p class="text-3xl font-bold text-white">{{ number_format($stats['total_siswa']) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-500 bg-opacity-20 rounded-xl flex items-center justify-center group-hover:bg-opacity-30">
                                <span class="text-2xl">👥</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-emerald-400 text-sm">↗️ Active learners</span>
                            <span class="text-emerald-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200">Click to view →</span>
                        </div>
                    </div>
                </a>

                <!-- Total Guru -->
                <a href="{{ route('guru.index') }}" class="block group">
                    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 cursor-pointer group-hover:border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Teachers</p>
                                <p class="text-3xl font-bold text-white">{{ number_format($stats['total_guru']) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center group-hover:bg-opacity-30">
                                <span class="text-2xl">👨‍🏫</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-blue-400 text-sm">📚 Mentoring students</span>
                            <span class="text-blue-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200">Click to view →</span>
                        </div>
                    </div>
                </a>

                <!-- Total Industri -->
                <a href="{{ route('industri.index') }}" class="block group">
                    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 cursor-pointer group-hover:border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Partner Industries</p>
                                <p class="text-3xl font-bold text-white">{{ number_format($stats['total_industri']) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-500 bg-opacity-20 rounded-xl flex items-center justify-center group-hover:bg-opacity-30">
                                <span class="text-2xl">🏢</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-purple-400 text-sm">🤝 Collaboration ready</span>
                            <span class="text-purple-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200">Click to view →</span>
                        </div>
                    </div>
                </a>

                <!-- PKL Aktif -->
                <a href="{{ route('pkl', ['status' => 'active']) }}" class="block group">
                    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 cursor-pointer group-hover:border-emerald-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Active PKL</p>
                                <p class="text-3xl font-bold text-emerald-400">{{ number_format($stats['total_pkl_aktif']) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-500 bg-opacity-20 rounded-xl flex items-center justify-center group-hover:bg-opacity-30">
                                <span class="text-2xl">⚡</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-emerald-400 text-sm">🔥 Currently running</span>
                            <span class="text-emerald-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200">Click to view →</span>
                        </div>
                    </div>
                </a>

                <!-- PKL Selesai -->
                <a href="{{ route('pkl', ['status' => 'completed']) }}" class="block group">
                    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 cursor-pointer group-hover:border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Completed PKL</p>
                                <p class="text-3xl font-bold text-green-400">{{ number_format($stats['pkl_selesai']) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center group-hover:bg-opacity-30">
                                <span class="text-2xl">✅</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-green-400 text-sm">🎉 Successfully finished</span>
                            <span class="text-green-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200">Click to view →</span>
                        </div>
                    </div>
                </a>

                <!-- PKL Akan Datang -->
                <a href="{{ route('pkl', ['status' => 'upcoming']) }}" class="block group">
                    <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300 hover:scale-105 cursor-pointer group-hover:border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Upcoming PKL</p>
                                <p class="text-3xl font-bold text-yellow-400">{{ number_format($stats['pkl_akan_datang']) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center group-hover:bg-opacity-30">
                                <span class="text-2xl">⏰</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-yellow-400 text-sm">📅 Coming soon</span>
                            <span class="text-yellow-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200">Click to view →</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent PKL Activities -->
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white">🔥 Recent PKL Activities</h3>
                    <a href="{{ route('pkl.index') }}" class="text-emerald-400 hover:text-emerald-300 text-sm font-medium transition-colors duration-200">View All →</a>
                </div>

                @if($recent_pkls->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_pkls as $pkl)
                            <div class="bg-gray-700 bg-opacity-50 rounded-xl p-4 hover:bg-opacity-70 transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-emerald-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                            <span class="text-emerald-400 font-bold text-sm">{{ substr($pkl->siswa->nama, 0, 2) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">{{ $pkl->siswa->nama }}</p>
                                            <p class="text-gray-400 text-sm">@ {{ $pkl->industri->nama }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-emerald-400 text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($pkl->mulai)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($pkl->selesai)->format('M d, Y') }}
                                        </p>
                                        <p class="text-gray-500 text-xs">Supervised by {{ $pkl->guru->nama }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">📝</div>
                        <p class="text-gray-400 text-lg">No PKL activities yet</p>
                        <p class="text-gray-500 text-sm">Start by creating your first PKL program!</p>
                    </div>
                @endif
            </div>

            {{-- <!-- Quick Actions -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('pkl.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl p-4 transition-all duration-200 hover:scale-105 hover:shadow-lg block text-center">
                    <div class="text-2xl mb-2">➕</div>
                    <div class="font-medium">Add New PKL</div>
                </a>
                <a href="{{ route('siswa.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-4 transition-all duration-200 hover:scale-105 hover:shadow-lg block text-center">
                    <div class="text-2xl mb-2">👥</div>
                    <div class="font-medium">Manage Students</div>
                </a>
                <a href="{{ route('industri.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white rounded-xl p-4 transition-all duration-200 hover:scale-105 hover:shadow-lg block text-center">
                    <div class="text-2xl mb-2">🏢</div>
                    <div class="font-medium">Partner Industries</div>
                </a>
                <a href="{{ route('laporan.index') }}" class="bg-orange-600 hover:bg-orange-700 text-white rounded-xl p-4 transition-all duration-200 hover:scale-105 hover:shadow-lg block text-center">
                    <div class="text-2xl mb-2">📊</div>
                    <div class="font-medium">View Reports</div>
                </a>
            </div> --}}
        </div>
    </div>
</div>
