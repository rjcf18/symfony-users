<?php declare(strict_types=1);
namespace App\Domain\Context\User\Listing;

use App\Domain\Context\User\Listing\Collection\UserCollection;

class ResponseModel
{
    private UserCollection $userCollection;

    public function __construct(UserCollection $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    public function getUserCollection(): UserCollection
    {
        return $this->userCollection;
    }
}