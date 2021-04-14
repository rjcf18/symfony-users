<?php declare(strict_types=1);
namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Context\User\Creation\UserRepository as UserCreationUserRepository;
use App\Domain\Context\User\Listing\UserRepository as UserListingUserRepository;
use App\Domain\Shared\Entity\User as UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements
    UserCreationUserRepository,
    UserListingUserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEntity::class);
    }

    public function findById(int $id): ?UserEntity
    {
        /** @var ?UserEntity $user */
        $user = $this->find($id);

        return $user;
    }

    public function findByEmail(string $email): ?UserEntity
    {
        /** @var ?UserEntity $user */
        $user = $this->findOneBy(['email' => $email]);

        return $user;
    }

    /**
     * @return UserEntity[]
     */
    public function findAll(): array
    {
        return $this->findBy([]);
    }

    /**
     * @param UserEntity $user
     *
     * @throws ORMException
     *
     * @return UserEntity
     */
    public function create(UserEntity $user): UserEntity
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * @param UserEntity $user
     *
     * @throws ORMException
     *
     * @return UserEntity
     */
    public function update(UserEntity $user): UserEntity
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * @param UserEntity $user
     *
     * @throws ORMException
     *
     * @return bool
     */
    public function delete(UserEntity $user): bool
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();

        $userExists = (bool) $this->find($user->getId());

        return !$userExists;
    }
}