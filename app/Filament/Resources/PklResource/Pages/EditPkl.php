<?php

namespace App\Filament\Resources\PklResource\Pages;

use App\Filament\Resources\PklResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPkl extends EditRecord
{
    protected static string $resource = PklResource::class;

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
}
