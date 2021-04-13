<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation\Exception;

use Exception;

class UserNameCannotBeEmptyException extends Exception
{
    public $message = 'User name cannot be empty';
}