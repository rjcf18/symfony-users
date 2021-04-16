<?php declare(strict_types=1);
namespace App\Domain\Context\User\Find\Exception;

use Exception;

class UserNotFoundException extends Exception
{
    public $message = 'User was not found for the provided ID';
}