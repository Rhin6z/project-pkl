<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PklResource\Pages;
use App\Models\Pkl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\SelectFilter;

class PklResource extends Resource
{
    protected static ?string $model = Pkl::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Data PKL';
    protected static ?string $navigationGroup = 'PKL Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('siswa_id')
                                    ->relationship('siswa', 'nama')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->label('Siswa'),
                                Select::make('industri_id')
                                    ->relationship('industri', 'nama')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->label('Industri'),
                                Select::make('guru_id')
                                    ->relationship('guru', 'nama')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->label('Guru Pembimbing'),
                                DatePicker::make('mulai')
                                    ->required()
                                    ->label('Tanggal Mulai'),
                                DatePicker::make('selesai')
                                    ->required()
                                    ->label('Tanggal Selesai')
                                    ->afterOrEqual('mulai'),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Siswa'),
                TextColumn::make('industri.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Industri'),
                TextColumn::make('guru.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Guru Pembimbing'),
                TextColumn::make('mulai')
                    ->date()
                    ->sortable()
                    ->label('Tanggal Mulai'),
                TextColumn::make('selesai')
                    ->date()
                    ->sortable()
                    ->label('Tanggal Selesai'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (Pkl $record): string => match (true) {
                        $record->selesai < now() => 'success',
                        $record->mulai <= now() && $record->selesai >= now() => 'warning',
                        default => 'info',
                    })
                    ->formatStateUsing(fn (Pkl $record): string => match (true) {
                        $record->selesai < now() => 'Selesai',
                        $record->mulai <= now() && $record->selesai >= now() => 'Aktif',
                        default => 'Akan Datang',
                    })
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('siswa')
                    ->relationship('siswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->label('Filter Siswa'),
                SelectFilter::make('industri')
                    ->relationship('industri', 'nama')
                    ->searchable()
                    ->preload()
                    ->label('Filter Industri'),
                SelectFilter::make('guru')
                    ->relationship('guru', 'nama')
                    ->searchable()
                    ->preload()
                    ->label('Filter Guru'),
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
            'index' => Pages\ListPkls::route('/'),
            'create' => Pages\CreatePkl::route('/create'),
            'edit' => Pages\EditPkl::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
