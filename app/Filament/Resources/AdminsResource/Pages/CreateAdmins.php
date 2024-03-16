<?php

namespace App\Filament\Resources\AdminsResource\Pages;

use App\Filament\Resources\AdminsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateAdmins extends CreateRecord
{
    protected static string $resource = AdminsResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['is_admin'] = 1;

        return parent::handleRecordCreation($data);
    }
}
