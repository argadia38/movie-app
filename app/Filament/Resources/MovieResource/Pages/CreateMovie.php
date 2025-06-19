<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log; // pastikan ini di paling atas
use App\Models\Movie;

class CreateMovie extends CreateRecord
{
    protected static string $resource = MovieResource::class;



    protected function handleRecordCreation(array $data): Movie
    {
        Log::debug('Sebelum casting:', [
            'value' => $data['is_featured'],
            'type' => gettype($data['is_featured']),
            'data' => $data,
        ]);

        // Force boolean string
        $data['is_featured'] = $data['is_featured'] ? 'true' : 'false';

        Log::debug('Setelah casting:', [
            'value' => $data['is_featured'],
            'type' => gettype($data['is_featured']),
        ]);

        return Movie::create($data);
    }


}
