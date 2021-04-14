<?php declare(strict_types=1);
namespace App\Domain\Context\User\Listing;

use App\Domain\Context\User\Listing\Collection\UserCollection;

class Service implements Handler
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return ResponseModel
     */
    public function list(): ResponseModel
    {
        return new ResponseModel(
            UserCollection::createFromArray($this->userRepository->findAll())
        );
    }
}