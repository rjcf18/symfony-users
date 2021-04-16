<?php declare(strict_types=1);
namespace App\Domain\Context\User\Find;

use App\Domain\Shared\Entity\User;

class ResponseModel
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}