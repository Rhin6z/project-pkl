<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Notifications\Notification;
use Illuminate\Database\QueryException;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Siswa SIJA';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 1;
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
                                TextInput::make('nis')
                                    ->required()
                                    ->maxLength(5)
                                    ->label('NIS'),
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
                                Toggle::make('status_lapor_pkl')
                                    ->required()
                                    ->label('Status Lapor PKL'),
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
                TextColumn::make('nis')
                    ->searchable()
                    ->sortable()
                    ->label('NIS'),
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
                IconColumn::make('status_lapor_pkl')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Status PKL'),
            ])
            ->filters([
                SelectFilter::make('gender')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->label('Jenis Kelamin'),
                Tables\Filters\TernaryFilter::make('status_lapor_pkl')
                    ->label('Status PKL'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                // Custom Delete Action dengan notifikasi
                Tables\Actions\DeleteAction::make()
                    ->before(function (Tables\Actions\DeleteAction $action, Siswa $record) {
                        // Cek apakah siswa memiliki data PKL
                        if ($record->pkls()->exists()) {
                            // Batalkan aksi delete
                            $action->cancel();

                            // Tampilkan notifikasi error
                            Notification::make()
                                ->title('Tidak dapat menghapus siswa!')
                                ->body('Siswa ' . $record->nama . ' masih memiliki data PKL yang terkait. Hapus data PKL terlebih dahulu sebelum menghapus siswa.')
                                ->danger()
                                ->persistent()
                                ->send();
                        }
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Custom Bulk Delete Action
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function (Tables\Actions\DeleteBulkAction $action, $records) {
                            $cannotDelete = [];
                            $toDelete = [];

                            foreach ($records as $record) {
                                if ($record->pkls()->exists()) {
                                    $cannotDelete[] = $record->nama;
                                } else {
                                    $toDelete[] = $record;
                                }
                            }

                            // Hapus yang bisa dihapus
                            if (!empty($toDelete)) {
                                foreach ($toDelete as $record) {
                                    $record->delete();
                                }

                                Notification::make()
                                    ->title('Berhasil menghapus ' . count($toDelete) . ' siswa')
                                    ->success()
                                    ->send();
                            }

                            // Tampilkan peringatan untuk yang tidak bisa dihapus
                            if (!empty($cannotDelete)) {
                                Notification::make()
                                    ->title('Beberapa siswa tidak dapat dihapus')
                                    ->body('Siswa berikut masih memiliki data PKL: ' . implode(', ', $cannotDelete))
                                    ->warning()
                                    ->persistent()
                                    ->send();
                            }
                        })
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
