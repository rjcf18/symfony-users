<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller\Users;

use App\Domain\Shared\Entity\User;

class UserArrayBuilder
{
    public static function build(User $user): array
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'createdAt' => $user->getCreatedAt(),
            'updatedAt' => $user->getUpdatedAt(),
        ];
    }
}