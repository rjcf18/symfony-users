<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller\Users;

use App\Domain\Context\User\Listing\Collection\UserCollection;
use App\Domain\Shared\Entity\User;

class UsersArrayBuilder
{
    public static function build(UserCollection $userCollection): array
    {
        return array_map(
            function (User $user) {
                return [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'createdAt' => $user->getCreatedAt(),
                    'updatedAt' => $user->getUpdatedAt(),
                ];
            },
            $userCollection->getAll()
        );
    }
}