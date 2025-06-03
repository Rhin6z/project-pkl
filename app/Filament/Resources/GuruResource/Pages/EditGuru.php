<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Filament\Resources\GuruResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuru extends EditRecord
{
    protected static string $resource = GuruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Format nomor telepon sebelum menyimpan
        if (isset($data['kontak'])) {
            $data['kontak'] = GuruResource::formatPhoneNumber($data['kontak']);
        }

        return $data;
    }
}   
