<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation;

use App\Domain\Context\User\Creation\Exception\UserEmailCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserNameCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserPasswordCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserWithEmailAlreadyExistsException;
use App\Domain\Context\User\Creation\Validator\Semantic as SemanticValidator;
use App\Domain\Shared\Entity\User;
use DateTime;

class Service implements Handler
{
    private SemanticValidator $semanticValidator;

    private UserRepository $userRepository;

    public function __construct(
        SemanticValidator $semanticValidator,
        UserRepository $userRepository
    ) {
        $this->semanticValidator = $semanticValidator;
        $this->userRepository = $userRepository;
    }

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
    public function create(RequestModel $useCaseRequest): ResponseModel
    {
        $user = $this->userRepository->findByEmail($useCaseRequest->getEmail());

        $this->semanticValidator->validate($useCaseRequest, $user);

        $createdUser = $this->userRepository->create(
            $this->buildUserToBeCreated($useCaseRequest)
        );

        return new ResponseModel($createdUser);
    }

    public function buildUserToBeCreated(RequestModel $useCaseRequest): User
    {
        $creationDateTime = new DateTime();

        $user = new User();
        $user->setName($useCaseRequest->getName());
        $user->setEmail($useCaseRequest->getEmail());
        $user->setPassword($this->encryptUserPassword($useCaseRequest));
        $user->setCreatedAt($creationDateTime);
        $user->setUpdatedAt($creationDateTime);

        return $user;
    }

    public function encryptUserPassword(RequestModel $useCaseRequest): string
    {
        return password_hash($useCaseRequest->getPassword(), PASSWORD_DEFAULT);
    }
}