<?php declare(strict_types=1);
namespace App\Domain\Context\User\Listing\Collection;

use App\Domain\Shared\Entity\User;

class UserCollection
{
    /** @var User[] */
    private array $users;

    private function __construct(array $users)
    {
        $this->users = $users;
    }

    public static function createEmpty(): self
    {
        return new self([]);
    }

    public static function createFromArray(array $users): self
    {
        return new self($users);
    }

    public function addUser(User $user): self
    {
        $this->users[] = $user;

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->users);
    }

    public function getAll(): array
    {
        return $this->users;
    }
}