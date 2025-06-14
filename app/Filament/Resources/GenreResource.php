<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenreResource\Pages;
use App\Models\Genre;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str; // <-- Jangan lupa import Str

class GenreResource extends Resource
{
    protected static ?string $model = Genre::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag'; // Memberi ikon pada menu navigasi

    public static function form(Form $form): Form
    {
         return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->live(debounce: 500) // Kita kembalikan live() untuk UX yang baik
                ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(Genre::class, 'slug', ignoreRecord: true)
                // Hapus ->disabled() dan ganti dengan ini:
                ->readOnly() // Tampilan lebih baik daripada disabled
                ->helperText('Slug akan dibuat otomatis dari Nama.'),
        ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Kolom bisa disembunyikan
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGenres::route('/'),
            'create' => Pages\CreateGenre::route('/create'),
            'edit' => Pages\EditGenre::route('/{record}/edit'),
        ];
    }
}
