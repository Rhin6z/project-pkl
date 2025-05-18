<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="text-xl font-semibold">Jumlah Siswa</h2>
        <p class="text-3xl font-bold text-blue-600">{{ $totalSiswa }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="text-xl font-semibold">Jumlah Guru</h2>
        <p class="text-3xl font-bold text-green-600">{{ $totalGuru }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="text-xl font-semibold">Jumlah Industri</h2>
        <p class="text-3xl font-bold text-purple-600">{{ $totalIndustri }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="text-xl font-semibold">Jumlah Laporan PKL</h2>
        <p class="text-3xl font-bold text-yellow-600">{{ $totalLaporan }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-5">
        <h2 class="text-xl font-semibold">% Laporan Disetujui</h2>
        <p class="text-3xl font-bold text-emerald-600">{{ $persenLaporanDisetujui }}%</p>
    </div>
</div>
