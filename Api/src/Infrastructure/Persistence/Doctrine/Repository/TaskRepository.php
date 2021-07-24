<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;


use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class TaskRepository extends MysqlRepository implements TaskRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }
}
