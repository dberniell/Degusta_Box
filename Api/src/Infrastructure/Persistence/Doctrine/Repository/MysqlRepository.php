<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;


use App\Domain\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

/**
 * Class MysqlRepository
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
abstract class MysqlRepository extends ServiceEntityRepository
{

    public function register($model): void
    {
        $this->_em->persist($model);
        $this->apply();
    }

    public function remove($model): void
    {
        $this->_em->remove($model);
        $this->apply();
    }

    public function apply(): void
    {
        $this->_em->flush();
    }

    /**
     * @throws NotFoundException
     * @throws NonUniqueResultException
     */
    protected function oneOrException(QueryBuilder $queryBuilder)
    {
        $model = $queryBuilder
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (null === $model) {
            throw new NotFoundException();
        }

        return $model;
    }
}
