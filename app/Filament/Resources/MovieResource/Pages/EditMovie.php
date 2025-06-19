<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditMovie extends EditRecord
{
    protected static string $resource = MovieResource::class;
    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        Log::debug('Sebelum casting update:', [
            'value' => $data['is_featured'],
            'type' => gettype($data['is_featured']),
        ]);

        $data['is_featured'] = $data['is_featured'] ? 'true' : 'false';

        Log::debug('Setelah casting update:', [
            'value' => $data['is_featured'],
            'type' => gettype($data['is_featured']),
        ]);

        $record->update($data);

        return $record;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
