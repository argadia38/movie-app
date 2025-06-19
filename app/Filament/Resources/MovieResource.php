<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Filament\Resources\MovieResource\RelationManagers;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Checkbox;


class MovieResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('genres');
    }

    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->required()->maxLength(255)->readOnly(),
                Textarea::make('synopsis')->required()->columnSpanFull(),
                TextInput::make('release_year')->required()->numeric()->minValue(1900),
                FileUpload::make('poster_path')->image()->directory('posters'),
                Select::make('genres')
                    ->multiple()
                    ->relationship('genres', 'name') // 'genres' is the relationship method name in Movie model
                    ->preload()
                    ->searchable(),
                Toggle::make('is_featured')
                ->label('Featured Movie?')
                ->default(false)
                ->afterStateHydrated(fn (callable $set, $state) => $set('is_featured', (bool) $state))
                ->dehydrateStateUsing(fn ($state) => filter_var($state, FILTER_VALIDATE_BOOLEAN)),
                Repeater::make('download_links')
                    ->schema([
                        TextInput::make('server_name')->required()->label('Server (e.g., Google Drive)'),
                        TextInput::make('quality')->required()->label('Quality (e.g., 720p)'),
                        TextInput::make('url')->url()->required()->label('URL'),
                    ])->columnSpanFull(),
                Repeater::make('stream_links')
                    ->schema([
                        TextInput::make('server_name')->required()->label('Server (e.g., Server 1)'),
                        TextInput::make('url')->url()->required()->label('Embed URL'),
                    ])->columnSpanFull(),
        ]);
    }

public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('genres.name')
                    ->badge() // ->badge() untuk tampilan lebih menarik
                    ->searchable(),
                TextColumn::make('release_year')->sortable(),
                IconColumn::make('is_featured')->boolean(),
            ])
            ->filters([
                // Filter akan ditambahkan di sini nanti
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
