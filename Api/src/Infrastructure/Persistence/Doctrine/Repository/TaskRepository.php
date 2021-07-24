<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;


use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

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
        return $this->findBy(['date' => $date]);
    }

    public function findByIndex(string $name, string $date): ?Task
    {
        return $this->find(['name' => $name, 'date' => $date]);
    }
}
