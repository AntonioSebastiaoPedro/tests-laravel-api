<?php 

namespace App\DTOs\Permissions;

readonly class CreatePermissionDTO
{
    public function __construct(
        public string $name,
        public string $description,
    ){}
}