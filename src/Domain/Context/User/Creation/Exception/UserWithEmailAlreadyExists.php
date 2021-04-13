<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation\Exception;

use Exception;

class UserWithEmailAlreadyExists extends Exception
{
    public $message = 'User with specified email already exists';
}