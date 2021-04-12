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
        /** @var ?UserEntity $airport */
        $airport = $this->find($id);

        return $airport;
    }

    /**
     * @param UserEntity $user
     *
     * @throws ORMException
     */
    public function delete(UserEntity $user): void
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @param UserEntity $user
     *
     * @throws ORMException
     */
    public function update(UserEntity $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @param UserEntity $user
     *
     * @throws ORMException
     */
    public function create(UserEntity $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}