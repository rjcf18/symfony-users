<?php declare(strict_types=1);
namespace App\Domain\Context\User\Creation\Exception;

use Exception;

class UserEmailCannotBeEmptyException extends Exception
{
    public $message = 'User email cannot be empty';
}