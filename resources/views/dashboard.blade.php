<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col">
        @if(auth()->user()->hasRole('siswa'))
            <livewire:front.dashboard.siswa-index />
        @else
            <livewire:front.dashboard.index />
        @endif
    </div>
</x-layouts.app>
