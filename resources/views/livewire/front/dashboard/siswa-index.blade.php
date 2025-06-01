<div class="min-h-screen">
    <!-- Header Welcome Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-12 rounded-3xl">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">{{ $greeting }}, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-blue-100 text-lg">{{ $currentTime }}</p>
                    <p class="text-blue-200 mt-2">Ready to track your PKL progress today?</p>
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
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full opacity-10 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300 rounded-full opacity-10 animate-pulse delay-1000"></div>
        </div>
    </div>

    <!-- Stats Cards Section -->
    <div class="px-6 py-8">
        <div class="mx-auto max-w-7xl">
            <h2 class="text-2xl font-bold text-white mb-6">📊 My PKL Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total PKL -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Total PKL</p>
                            <p class="text-3xl font-bold text-white">{{ number_format($stats['total_pkl']) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📚</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-blue-400 text-sm">📖 My learning journey</span>
                    </div>
                </div>

                <!-- PKL Aktif -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Active PKL</p>
                            <p class="text-3xl font-bold text-emerald-400">{{ number_format($stats['pkl_aktif']) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">⚡</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-emerald-400 text-sm">🔥 Currently learning</span>
                    </div>
                </div>

                <!-- PKL Selesai -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Completed PKL</p>
                            <p class="text-3xl font-bold text-green-400">{{ number_format($stats['pkl_selesai']) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">✅</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-green-400 text-sm">🎉 Successfully finished</span>
                    </div>
                </div>

                <!-- PKL Akan Datang -->
                <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6 hover:bg-opacity-70 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Upcoming PKL</p>
                            <p class="text-3xl font-bold text-yellow-400">{{ number_format($stats['pkl_akan_datang']) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-500 bg-opacity-20 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">⏰</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-yellow-400 text-sm">📅 Coming soon</span>
                    </div>
                </div>
            </div>

            <!-- Current Active PKL -->
            @if($current_pkl)
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-2xl p-6 mb-8">
                    <div class="flex items-center justify-between text-white">
                        <div>
                            <h3 class="text-xl font-bold mb-2">🔥 Current PKL Activity</h3>
                            <p class="text-emerald-100 text-lg font-medium">{{ $current_pkl->industri->nama }}</p>
                            <p class="text-emerald-200 text-sm">Supervised by {{ $current_pkl->guru->nama }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-emerald-100 text-sm">Period</p>
                            <p class="text-white font-medium">
                                {{ \Carbon\Carbon::parse($current_pkl->mulai)->format('M d, Y') }} -
                                {{ \Carbon\Carbon::parse($current_pkl->selesai)->format('M d, Y') }}
                            </p>
                            <p class="text-emerald-200 text-xs mt-1">
                                {{ \Carbon\Carbon::parse($current_pkl->selesai)->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- My PKL History -->
            <div class="bg-gray-800 bg-opacity-50 backdrop-blur-lg border border-gray-700 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-white">📋 My PKL History</h3>
                    <a href="{{ route('pkl') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors duration-200">View All →</a>
                </div>

                @if($my_pkls->count() > 0)
                    <div class="space-y-4">
                        @foreach($my_pkls as $pkl)
                            <div class="bg-gray-700 bg-opacity-50 rounded-xl p-4 hover:bg-opacity-70 transition-all duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-blue-500 bg-opacity-20 rounded-full flex items-center justify-center">
                                            <span class="text-blue-400 font-bold text-sm">{{ substr($pkl->industri->nama, 0, 2) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">{{ $pkl->industri->nama }}</p>
                                            <p class="text-gray-400 text-sm">Supervised by {{ $pkl->guru->nama }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-blue-400 text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($pkl->mulai)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($pkl->selesai)->format('M d, Y') }}
                                        </p>
                                        @if(\Carbon\Carbon::parse($pkl->selesai)->isPast())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-500 bg-opacity-20 text-green-400">
                                                ✅ Completed
                                            </span>
                                        @elseif(\Carbon\Carbon::parse($pkl->mulai)->isFuture())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-500 bg-opacity-20 text-yellow-400">
                                                ⏰ Upcoming
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-emerald-500 bg-opacity-20 text-emerald-400">
                                                ⚡ Active
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">📚</div>
                        <p class="text-gray-400 text-lg">No PKL history yet</p>
                        <p class="text-gray-500 text-sm">Your PKL activities will appear here once assigned!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
