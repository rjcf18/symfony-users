<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation\Validator;

use App\Domain\Context\User\Creation\Exception\UserEmailCannotBeEmpty;
use App\Domain\Context\User\Creation\Exception\UserNameCannotBeEmpty;
use App\Domain\Context\User\Creation\Exception\UserPasswordCannotBeEmpty;
use App\Domain\Context\User\Creation\Exception\UserWithEmailAlreadyExists;
use App\Domain\Context\User\Creation\RequestModel;
use App\Domain\Shared\Entity\User;

class Semantic
{
    /**
     * @param RequestModel $useCaseRequest
     * @param ?User $user
     *
     * @throws UserEmailCannotBeEmpty
     * @throws UserNameCannotBeEmpty
     * @throws UserPasswordCannotBeEmpty
     * @throws UserWithEmailAlreadyExists
     *
     * @return bool
     */
    public function validate(RequestModel $useCaseRequest, ?User $user): bool
    {
        $this->validateEmptyFields($useCaseRequest);

        $this->validateUserAlreadyExists($user);

        return true;
    }

    /**
     * @param RequestModel $useCaseRequest
     *
     * @throws UserEmailCannotBeEmpty
     * @throws UserNameCannotBeEmpty
     * @throws UserPasswordCannotBeEmpty
     */
    private function validateEmptyFields(RequestModel $useCaseRequest): void
    {
        if (empty($useCaseRequest->getName())) {
            throw new UserNameCannotBeEmpty();
        }

        if (empty($useCaseRequest->getPassword())) {
            throw new UserPasswordCannotBeEmpty();
        }

        if (empty($useCaseRequest->getEmail())) {
            throw new UserEmailCannotBeEmpty();
        }
    }

    /**
     * @param ?User $user
     *
     * @throws UserWithEmailAlreadyExists
     */
    public function validateUserAlreadyExists(?User $user): void
    {
        if (!empty($user)) {
            throw new UserWithEmailAlreadyExists();
        }
    }
}