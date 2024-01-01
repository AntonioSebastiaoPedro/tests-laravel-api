<?php
namespace App\DTOs\Users;

readonly class EditUserDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $password = null,
    ){}
}