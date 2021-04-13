<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation;

use App\Domain\Context\User\Creation\Exception\UserEmailCannotBeEmpty;
use App\Domain\Context\User\Creation\Exception\UserNameCannotBeEmpty;
use App\Domain\Context\User\Creation\Exception\UserPasswordCannotBeEmpty;
use App\Domain\Context\User\Creation\Exception\UserWithEmailAlreadyExists;

interface Handler
{
    /**
     * @param RequestModel $useCaseRequest
     *
     * @throws UserEmailCannotBeEmpty
     * @throws UserNameCannotBeEmpty
     * @throws UserPasswordCannotBeEmpty
     * @throws UserWithEmailAlreadyExists
     *
     * @return ResponseModel
     */
    public function create(RequestModel $useCaseRequest): ResponseModel;
}