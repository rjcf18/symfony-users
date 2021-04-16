<?php declare(strict_types=1);
namespace App\Domain\Context\User\Find\Validator;

use App\Domain\Context\User\Find\Exception\UserNotFoundException;
use App\Domain\Shared\Entity\User;

class Semantic
{
    /**
     * @param ?User $user
     *
     * @throws UserNotFoundException
     *
     * @return bool
     */
    public function validate(?User $user): bool
    {
        $this->validateUserWasFound($user);

        return true;
    }

    /**
     * @param ?User $user
     *
     * @throws UserNotFoundException
     */
    private function validateUserWasFound(?User $user): void
    {
        if (empty($user)) {
            throw new UserNotFoundException();
        }
    }
}