<?php


namespace App\Infrastructure\UI\Controller;


use App\Application\Queries\TasksByDateQuery;
use App\Application\Task\Commands\SaveTaskCommand;
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
     * @param MessageBusInterface $messageBus
     *
     * @return JsonResponse
     */
    public function saveTask(Request $request, MessageBusInterface $messageBus): JsonResponse
    {
        $taskName = $request->request->get('name');
        $taskDate = date('d-m-y');
        $taskDuration = $request->request->get('duration');

        $command = new SaveTaskCommand($taskName, $taskDate, $taskDuration);

        $messageBus->dispatch($command);

        $query = new TasksByDateQuery($taskDate);

        $tasks = $this->handle($query);
        return new JsonResponse($tasks);
    }
}
