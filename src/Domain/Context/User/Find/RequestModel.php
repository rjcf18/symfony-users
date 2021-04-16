<?php declare(strict_types=1);
namespace App\Domain\Context\User\Find;

class RequestModel
{
    private int $userId;

    public function __construct(int $userID)
    {
        $this->userId = $userID;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}