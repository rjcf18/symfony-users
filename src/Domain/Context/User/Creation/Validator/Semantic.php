<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation\Validator;

use App\Domain\Context\User\Creation\Exception\UserEmailCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserNameCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserPasswordCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserWithEmailAlreadyExistsException;
use App\Domain\Context\User\Creation\RequestModel;
use App\Domain\Shared\Entity\User;

class Semantic
{
    /**
     * @param RequestModel $useCaseRequest
     * @param ?User $user
     *
     * @return bool
     *@throws UserNameCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     *
     * @throws UserEmailCannotBeEmptyException
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
     * @throws UserEmailCannotBeEmptyException
     * @throws UserNameCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     */
    private function validateEmptyFields(RequestModel $useCaseRequest): void
    {
        if (empty($useCaseRequest->getName())) {
            throw new UserNameCannotBeEmptyException();
        }

        if (empty($useCaseRequest->getEmail())) {
            throw new UserEmailCannotBeEmptyException();
        }

        if (empty($useCaseRequest->getPassword())) {
            throw new UserPasswordCannotBeEmptyException();
        }
    }

    /**
     * @param ?User $user
     *
     * @throws UserWithEmailAlreadyExistsException
     */
    public function validateUserAlreadyExists(?User $user): void
    {
        if (!empty($user)) {
            throw new UserWithEmailAlreadyExistsException();
        }
    }
}