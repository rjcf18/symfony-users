<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation;

use App\Domain\Shared\Entity\User;

interface UserRepository
{
    public function findByEmail(string $email): ?User;

    public function create(User $user): User;
}