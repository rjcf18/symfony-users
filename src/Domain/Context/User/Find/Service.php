<?php declare(strict_types=1);
namespace App\Domain\Context\User\Find;

use App\Domain\Context\User\Find\Exception\UserNotFoundException;
use App\Domain\Context\User\Find\Validator\Semantic as SemanticValidator;

class Service implements Handler
{
    private SemanticValidator $semanticValidator;

    private UserRepository $userRepository;

    public function __construct(SemanticValidator $semanticValidator, UserRepository $userRepository)
    {
        $this->semanticValidator = $semanticValidator;
        $this->userRepository = $userRepository;
    }

    /**
     * @param RequestModel $useCaseRequest
     *
     * @throws UserNotFoundException
     *
     * @return ResponseModel
     */
    public function find(RequestModel $useCaseRequest): ResponseModel
    {
        $user = $this->userRepository->findById($useCaseRequest->getUserId());

        $this->semanticValidator->validate($user);

        return new ResponseModel($user);
    }
}