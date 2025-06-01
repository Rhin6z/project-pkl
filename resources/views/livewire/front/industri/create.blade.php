<!-- Modal Overlay -->
<div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900 opacity-40" wire:click="closeModal"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-gray-800 rounded-2xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">

            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z" clip-rule="evenodd" />
                    </svg>
                    Tambah Industri Baru
                </h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="store" class="space-y-4">

                <!-- Nama Industri -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-300 mb-2">
                        Nama Industri <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama"
                        wire:model="nama"
                        placeholder="Masukkan nama industri"
                        class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                    >
                    @error('nama')
                        <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bidang Usaha -->
                <div>
                    <label for="bidang_usaha_form" class="block text-sm font-medium text-gray-300 mb-2">
                        Bidang Usaha <span class="text-red-400">*</span>
                    </label>
                    <input
                        type="text"
                        id="bidang_usaha_form"
                        wire:model="bidang_usaha_form"
                        placeholder="Contoh: Teknologi Informasi, Manufaktur, dll"
                        class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                    >
                    @error('bidang_usaha_form')
                        <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-300 mb-2">
                        Alamat
                    </label>
                    <textarea
                        id="alamat"
                        wire:model="alamat"
                        rows="3"
                        placeholder="Masukkan alamat lengkap industri"
                        class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 resize-none"
                    ></textarea>
                    @error('alamat')
                        <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kontak -->
                <div>
                    <label for="kontak" class="block text-sm font-medium text-gray-300 mb-2">
                        Nomor Kontak
                    </label>
                    <input
                        type="text"
                        id="kontak"
                        wire:model="kontak"
                        placeholder="Contoh: +62 812-3456-7890"
                        class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                    >
                    @error('kontak')
                        <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        wire:model="email"
                        placeholder="contoh@email.com"
                        class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                    >
                    @error('email')
                        <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Website -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-300 mb-2">
                        Website
                    </label>
                    <input
                        type="url"
                        id="website"
                        wire:model="website"
                        placeholder="https://www.contoh.com"
                        class="w-full bg-gray-700 bg-opacity-50 border border-gray-600 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200"
                    >
                    @error('website')
                        <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-700">
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-medium transition-all duration-200 hover:scale-105"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium transition-all duration-200 hover:scale-105 flex items-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Simpan Industri
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
