<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation;

use App\Domain\Context\User\Creation\Exception\UserEmailCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserNameCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserPasswordCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserWithEmailAlreadyExistsException;

interface Handler
{
    /**
     * @param RequestModel $useCaseRequest
     *
     * @throws UserNameCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     * @throws UserEmailCannotBeEmptyException
     *
     * @return ResponseModel
     */
    public function create(RequestModel $useCaseRequest): ResponseModel;
}