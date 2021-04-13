<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation\Exception;

use Exception;

class UserPasswordCannotBeEmptyException extends Exception
{
    public $message = 'User password cannot be empty';
}