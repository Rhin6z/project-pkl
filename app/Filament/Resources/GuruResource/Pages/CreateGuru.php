<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Filament\Resources\GuruResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Format nomor telepon sebelum menyimpan
        if (isset($data['kontak'])) {
            $data['kontak'] = GuruResource::formatPhoneNumber($data['kontak']);
        }

        return $data;
    }
}
