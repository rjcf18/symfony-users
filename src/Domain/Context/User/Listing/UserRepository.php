<?php declare(strict_types=1);
namespace App\Domain\Context\User\Listing;

use App\Domain\Shared\Entity\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;
}