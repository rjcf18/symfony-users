<?php declare(strict_types=1);
namespace App\Domain\Context\User\Find;

use App\Domain\Shared\Entity\User;

interface UserRepository
{
    public function findById(int $id): ?User;
}