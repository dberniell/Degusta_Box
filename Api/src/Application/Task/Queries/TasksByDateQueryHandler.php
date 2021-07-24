<?php
declare(strict_types=1);

namespace App\Application\Queries;

use App\Domain\Task\TaskRepositoryInterface;
use Exception;

/**
 * Class TasksByDateQueryHandler
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
class TasksByDateQueryHandler
{

    private TaskRepositoryInterface $taskRepository;

    /**
     * TasksByDateQueryHandler constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @throws Exception
     */
    public function __invoke(TasksByDateQuery $query): array
    {
        $date  = new \DateTimeImmutable($query->date());

        return $this->taskRepository->findAllByDate($date);
    }
}
