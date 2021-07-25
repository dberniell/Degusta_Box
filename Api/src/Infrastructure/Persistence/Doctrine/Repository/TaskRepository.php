<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;


use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class TaskRepository
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
class TaskRepository extends MysqlRepository implements TaskRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function save(Task $task): void
    {
        $this->register($task);
    }

    public function findAllByDate(\DateTime $date): array
    {
        return $this->_em->createQuery('SELECT t FROM ' . Task::class . ' t WHERE t.date = :date')
            ->setParameter('date', $date->format('Y-m-d'))
            ->getArrayResult();
    }

    public function findByIndex(string $name): ?Task
    {
        return $this->findOneBy(['name' => $name]);
    }
}
