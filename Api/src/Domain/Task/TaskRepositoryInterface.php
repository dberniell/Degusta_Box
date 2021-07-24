<?php
declare(strict_types=1);

namespace App\Domain\Task;

/**
 * Interface TaskRepositoryInterface
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
interface TaskRepositoryInterface
{
    public function save(Task $task): void;

    public function findAllByDate(\DateTime $date): array;

    public function findByIndex(string $name, string $date): ?Task;
}
