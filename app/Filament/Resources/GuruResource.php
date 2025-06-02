<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Notifications\Notification;
use Illuminate\Database\QueryException;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Guru SIJA';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nama')
                                    ->required()
                                    ->maxLength(50)
                                    ->label('Nama Lengkap'),
                                TextInput::make('nip')
                                    ->required()
                                    ->maxLength(18)
                                    ->label('NIP'),
                                Select::make('gender')
                                    ->required()
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                    ])
                                    ->label('Jenis Kelamin'),
                                TextInput::make('kontak')
                                    ->required()
                                    ->maxLength(16)
                                    ->tel()
                                    ->label('Nomor Telepon'),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(30)
                                    ->label('Email'),
                            ]),
                        Forms\Components\Textarea::make('alamat')
                            ->required()
                            ->columnSpanFull()
                            ->label('Alamat Lengkap'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                TextColumn::make('nip')
                    ->searchable()
                    ->sortable()
                    ->label('NIP'),
                TextColumn::make('gender')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'L' => 'info',
                        'P' => 'success',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    })
                    ->label('Gender'),
                TextColumn::make('kontak')
                    ->searchable()
                    ->label('Kontak'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
            ])
            ->filters([
                SelectFilter::make('gender')
                    ->options([
                        'L',
                        'P',
                    ])
                    ->label('Jenis Kelamin'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Custom Delete Action with error handling
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record) {
                        try {
                            $record->delete();

                            Notification::make()
                                ->title('Berhasil dihapus')
                                ->body('Data guru berhasil dihapus.')
                                ->success()
                                ->send();

                        } catch (QueryException $e) {
                            // Check if it's a foreign key constraint error
                            if ($e->getCode() === '23000') {
                                Notification::make()
                                    ->title('Tidak dapat menghapus data')
                                    ->body('Data guru ini tidak dapat dihapus karena masih terkait dengan data lain (seperti PKL atau mata pelajaran). Silakan hapus data terkait terlebih dahulu.')
                                    ->danger()
                                    ->persistent()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Terjadi kesalahan')
                                    ->body('Gagal menghapus data guru. Silakan coba lagi.')
                                    ->danger()
                                    ->send();
                            }
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Data Guru')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data guru ini? Data yang sudah dihapus tidak dapat dikembalikan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Custom Bulk Delete Action with error handling
                    Tables\Actions\BulkAction::make('delete')
                        ->label('Hapus Terpilih')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->action(function ($records) {
                            $deletedCount = 0;
                            $failedCount = 0;
                            $constraintFailures = [];

                            foreach ($records as $record) {
                                try {
                                    $record->delete();
                                    $deletedCount++;
                                } catch (QueryException $e) {
                                    if ($e->getCode() === '23000') {
                                        $constraintFailures[] = $record->nama;
                                        $failedCount++;
                                    } else {
                                        $failedCount++;
                                    }
                                }
                            }

                            // Show appropriate notifications
                            if ($deletedCount > 0) {
                                Notification::make()
                                    ->title('Berhasil menghapus ' . $deletedCount . ' data guru')
                                    ->success()
                                    ->send();
                            }

                            if (count($constraintFailures) > 0) {
                                Notification::make()
                                    ->title('Beberapa data tidak dapat dihapus')
                                    ->body('Data guru berikut tidak dapat dihapus karena masih terkait dengan data lain: ' . implode(', ', $constraintFailures))
                                    ->warning()
                                    ->persistent()
                                    ->send();
                            }

                            if ($failedCount > 0 && count($constraintFailures) === 0) {
                                Notification::make()
                                    ->title('Gagal menghapus ' . $failedCount . ' data')
                                    ->body('Terjadi kesalahan saat menghapus beberapa data.')
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Data Guru Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menghapus semua data guru yang dipilih? Data yang sudah dihapus tidak dapat dikembalikan.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
