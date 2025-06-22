<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TvSeriesResource\Pages;
use App\Models\TvSeries;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TvSeriesResource extends Resource
{
    protected static ?string $model = TvSeries::class;

    protected static ?string $navigationIcon = 'heroicon-o-tv';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(TvSeries::class, 'slug', ignoreRecord: true),
                Forms\Components\RichEditor::make('synopsis')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('poster_path')
                    ->directory('posters'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('poster_path')->disk('public'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('slug'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTvSeries::route('/'),
            'create' => Pages\CreateTvSeries::route('/create'),
            'edit' => Pages\EditTvSeries::route('/{record}/edit'),
        ];
    }
}
