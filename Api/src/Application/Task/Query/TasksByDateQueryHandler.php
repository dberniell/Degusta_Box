<?php
declare(strict_types=1);

namespace App\Application\Task\Query;

use App\Application\QueryHandlerInterface;
use App\Domain\Task\TaskRepositoryInterface;
use Exception;

/**
 * Class TasksByDateQueryHandler
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
class TasksByDateQueryHandler implements QueryHandlerInterface
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
        $date  = \DateTime::createFromFormat('d/m/Y', $query->date());

        return $this->taskRepository->findAllByDate($date);
    }
}
