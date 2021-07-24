<?php
declare(strict_types=1);

namespace App\Application\Task\Commands;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use Exception;

/**
 * Class SaveTaskCommandHandler
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
class SaveTaskCommandHandler
{

    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param SaveTaskCommand $command
     *
     * @throws Exception
     */
    public function __invoke(SaveTaskCommand $command): void
    {
        $task = $this->taskRepository->findByIndex($command->name(), $command->date());

        if ($task) {
            $task->increaseDuration($command->duration());
        } else {
            $task = new Task($command->name(), new \DateTimeImmutable($command->date()), $command->duration());
        }

        $this->taskRepository->save($task);
    }
}
