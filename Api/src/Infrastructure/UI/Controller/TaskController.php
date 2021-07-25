<?php


namespace App\Infrastructure\UI\Controller;


use App\Application\Task\Commands\SaveTaskCommand;
use App\Application\Task\Query\TasksByDateQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class TaskController
{
    use HandleTrait;

    /**
     * @Route("/task", name="save_task", methods={"POST"})
     *
     * @param Request             $request
     * @param MessageBusInterface $commandBus
     *
     * @return JsonResponse
     * @throws \JsonException
     */
    public function saveTask(Request $request, MessageBusInterface $commandBus, MessageBusInterface $queryBus): JsonResponse
    {
        $this->messageBus = $queryBus;

        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $taskName = $content['name'];
        $taskDate = date('d/m/Y');
        $taskDuration = $content['duration'];

        $command = new SaveTaskCommand($taskName, $taskDate, $taskDuration);

        $commandBus->dispatch($command);

        $query = new TasksByDateQuery($taskDate);

        $tasks = $this->handle($query);
        return new JsonResponse($tasks);
    }
}
