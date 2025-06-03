<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiswa extends EditRecord
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn (): bool =>
                    // Hanya tampilkan tombol delete jika PKL sudah selesai
                    $this->record->selesai < now()
                ),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Format nomor telepon sebelum menyimpan
        if (isset($data['kontak'])) {
            $data['kontak'] = SiswaResource::formatPhoneNumber($data['kontak']);
        }

        return $data;
    }
}
