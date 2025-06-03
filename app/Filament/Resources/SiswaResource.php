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
use Illuminate\Validation\ValidationException;

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
                                    ->label('NIS')
                                    ->unique(
                                        table: 'siswas',
                                        column: 'nis',
                                        ignoreRecord: true
                                    )
                                    ->validationMessages([
                                        'unique' => 'NIS ini sudah digunakan oleh siswa lain. Silakan gunakan NIS yang berbeda.',
                                    ]),
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
                                    ->label('Nomor Telepon')
                                    ->placeholder('0856123456 atau 856123456')
                                    ->helperText('Nomor akan otomatis diformat menjadi +62'),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(30)
                                    ->label('Email')
                                    ->unique(
                                        table: 'siswas',
                                        column: 'email',
                                        ignoreRecord: true
                                    )
                                    ->validationMessages([
                                        'unique' => 'Email ini sudah digunakan oleh siswa lain. Silakan gunakan email yang berbeda.',
                                        'email' => 'Format email tidak valid.',
                                        'max' => 'Email tidak boleh lebih dari 30 karakter.',
                                    ])
                                    ->afterStateUpdated(function ($state, callable $set, callable $get, $component) {
                                        if (!empty($state)) {
                                            // Cek apakah email sudah ada di database
                                            $existingEmail = Siswa::where('email', $state)
                                                ->when($component->getRecord(), function ($query) use ($component) {
                                                    $query->where('id', '!=', $component->getRecord()->id);
                                                })
                                                ->first();

                                            if ($existingEmail) {
                                                Notification::make()
                                                    ->title('Email Sudah Digunakan!')
                                                    ->body("Email '{$state}' sudah digunakan oleh siswa: {$existingEmail->nama}")
                                                    ->danger()
                                                    ->duration(5000)
                                                    ->send();
                                            }
                                        }
                                    }),
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

                // Delete Action hanya tampil jika siswa tidak memiliki data PKL
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (Siswa $record): bool =>
                        // Hanya tampilkan tombol delete jika siswa tidak memiliki data PKL
                        !$record->pkls()->exists()
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Bulk Delete Action hanya tampil jika ada siswa yang bisa dihapus
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn (): bool =>
                            // Hanya tampilkan bulk delete jika ada siswa yang tidak memiliki data PKL
                            static::getModel()::whereDoesntHave('pkls')->exists()
                        )
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

    // Method untuk format nomor telepon
    public static function formatPhoneNumber($phone)
    {
        // Hapus semua karakter non-numerik
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika dimulai dengan 0, hapus 0 dan tambahkan +62
        if (substr($phone, 0, 1) === '0') {
            $phone = '+62' . substr($phone, 1);
        }
        // Jika dimulai dengan 62, tambahkan + di depan
        elseif (substr($phone, 0, 2) === '62') {
            $phone = '+' . $phone;
        }
        // Jika tidak dimulai dengan 0 atau 62, asumsikan nomor lokal dan tambahkan +62
        elseif (!str_starts_with($phone, '+62')) {
            $phone = '+62' . $phone;
        }

        return $phone;
    }
}
