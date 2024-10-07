<?php

namespace App\DTO\Permissions;

class CreatePermissionDTO
{
    public function __construct(
        readonly public string $name,
        readonly public string $description = '',
        //readonly public ?string $description = '', //interregação deixa o campo opcional
    ) {
        //
    }
}
