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
                                    ->label('Nomor Telepon')
                                    ->placeholder('0856123456 atau 856123456')
                                    ->helperText('Nomor akan otomatis diformat menjadi +62'),
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
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->label('Jenis Kelamin'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
