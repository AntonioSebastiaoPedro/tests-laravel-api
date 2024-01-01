<?php 

namespace App\DTOs\Permissions;

readonly class EditPermissionDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
    ){}
}