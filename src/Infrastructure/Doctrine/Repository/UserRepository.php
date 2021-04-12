<?php declare(strict_types=1);
namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Shared\Entity\User as UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEntity::class);
    }

    public function getById(int $id): ?UserEntity
    {
        /** @var ?UserEntity $user */
        $user = $this->find($id);

        return $user;
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

        return (bool) $this->find($user->getId());
    }
}