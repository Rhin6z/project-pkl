<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Format nomor telepon sebelum menyimpan
        if (isset($data['kontak'])) {
            $data['kontak'] = SiswaResource::formatPhoneNumber($data['kontak']);
        }

        return $data;
    }
}
