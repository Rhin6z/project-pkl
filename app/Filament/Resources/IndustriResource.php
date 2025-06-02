<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndustriResource\Pages;
use App\Models\Industri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\SelectFilter;

class IndustriResource extends Resource
{
    protected static ?string $model = Industri::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Industri';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 3;
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
                                    ->maxLength(255)
                                    ->label('Nama Perusahaan'),
                                TextInput::make('bidang_usaha')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Bidang Usaha'),
                                TextInput::make('kontak')
                                    ->required()
                                    ->maxLength(255)
                                    ->tel()
                                    ->label('Nomor Telepon'),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Email'),
                                TextInput::make('website')
                                    ->required()
                                    ->maxLength(255)
                                    ->url()
                                    ->label('Website'),
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
                    ->label('Nama Perusahaan'),
                TextColumn::make('bidang_usaha')
                    ->searchable()
                    ->sortable()
                    ->label('Bidang Usaha'),
                TextColumn::make('kontak')
                    ->searchable()
                    ->label('Kontak'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                TextColumn::make('website')
                    ->searchable()
                    ->label('Website')
                    ->url(fn (Industri $record): string => $record->website)
                    ->openUrlInNewTab(),
            ])
            ->filters([
                SelectFilter::make('bidang_usaha')
                    ->options(fn (): array => Industri::query()
                        ->distinct()
                        ->pluck('bidang_usaha', 'bidang_usaha')
                        ->toArray())
                    ->label('Bidang Usaha'),
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
            'index' => Pages\ListIndustris::route('/'),
            'create' => Pages\CreateIndustri::route('/create'),
            'edit' => Pages\EditIndustri::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> dev
