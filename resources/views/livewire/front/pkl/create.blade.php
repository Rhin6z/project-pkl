<div class="fixed inset-0 z-30 overflow-y-auto ease-out duration-400">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-900 opacity-40"></div>
    </div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

    <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-gray-800 rounded-lg shadow-xl border border-gray-700 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="py-5 px-6">
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-bold text-white">Lapor PKL</h2>
          <button wire:click="closeModal()" class="text-gray-400 hover:text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        @if($siswa_login && isset($siswa_login->nama))
        <p class="text-gray-300 mt-1">{{ $siswa_login->nama }}</p>
        <div class="border-t border-gray-700 my-3"></div>
        @endif
        @if(!auth()->user()->hasRole('siswa') && isset($siswa) && $siswa && isset($siswa->nama))
        <p class="text-gray-300 mt-1">{{ $siswa->nama }}</p>
        <div class="border-t border-gray-700 my-3"></div>
        @endif
      </div>

      <form>
        <div class="px-6 pt-2 pb-4 bg-gray-800">
          <div>
            <!-- Fieldset Siswa -->
            <fieldset class="border border-gray-600 rounded-md p-4 mb-5 bg-gray-700/30">
              <legend class="text-lg text-gray-300 px-2">Siswa</legend>
              <div class="mb-4">
                @if(auth()->user()->hasRole('siswa'))
                  <!-- Jika role siswa, hanya tampilkan data siswa yang login -->
                  <select wire:model="siswaId" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @if($siswa_login && isset($siswa_login->id) && isset($siswa_login->nama))
                      <option value="{{ $siswa_login->id }}">{{ $siswa_login->nama }}</option>
                    @else
                      <option value="">Data siswa tidak ditemukan</option>
                    @endif
                  </select>
                @else
                  <!-- Jika role selain siswa, dapat memilih semua data siswa -->
                  <select wire:model="siswaId" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Siswa</option>
                    @if(isset($siswas))
                      @foreach ($siswas as $siswa_item)
                        <option value="{{ $siswa_item->id }}">{{ $siswa_item->nama }}</option>
                      @endforeach
                    @endif
                  </select>
                @endif
                @error('siswaId')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>
            </fieldset>

            <!-- Fieldset Industri -->
            <fieldset class="border border-gray-600 rounded-md p-4 mb-5 bg-gray-700/30">
              <legend class="text-lg text-gray-300 px-2">Industri</legend>
              <div class="mb-4">
                <select wire:model="industriId" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  <option value="">Pilih Industri</option>
                  @foreach ($industris as $industri)
                    <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                  @endforeach
                </select>
                @error('industriId')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>
            </fieldset>

            <!-- Fieldset Guru Pembimbing -->
            <fieldset class="border border-gray-600 rounded-md p-4 mb-5 bg-gray-700/30">
              <legend class="text-lg text-gray-300 px-2">Guru Pembimbing</legend>
              <div class="mb-4">
                <select wire:model="guruId" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  <option value="">Pilih Guru Pembimbing PKL</option>
                  @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                  @endforeach
                </select>
                @error('guruId')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>
            </fieldset>

            <!-- Fieldset Pelaksanaan PKL -->
            <fieldset class="border border-gray-600 rounded-md p-4 mb-2 bg-gray-700/30">
              <legend class="text-lg text-gray-300 px-2">Pelaksanaan PKL</legend>

              <div class="mb-4">
                <label for="Mulai" class="block mb-2 text-sm font-medium text-gray-300">Tanggal Mulai</label>
                <input wire:model="mulai" type="date" id="start-date" name="start-date" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('mulai')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-2">
                <label for="Selesai" class="block mb-2 text-sm font-medium text-gray-300">Tanggal Selesai</label>
                <input wire:model="selesai" type="date" id="end-date" name="end-date" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('selesai')
                  <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
                @enderror
              </div>
            </fieldset>
          </div>
        </div>

        <div class="px-6 py-4 bg-gray-900/50 border-t border-gray-700 sm:flex sm:flex-row-reverse">
          <button wire:click.prevent="store()" type="button" class="w-full sm:w-auto sm:ml-3 mb-3 sm:mb-0 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-300 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Simpan
          </button>

          <button wire:click="closeModal()" type="button" class="w-full sm:w-auto px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-200 font-medium rounded-lg transition duration-300 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
            Batal
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
