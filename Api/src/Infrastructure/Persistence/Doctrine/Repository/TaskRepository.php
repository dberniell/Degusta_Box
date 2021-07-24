<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;


use App\Domain\Task\TaskRepositoryInterface;

class TaskRepository extends MysqlRepository implements TaskRepositoryInterface
{

}
