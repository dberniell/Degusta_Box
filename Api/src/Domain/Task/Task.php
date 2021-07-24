<?php

declare(strict_types=1);

namespace App\Domain\Task;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Task Entity
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 *
 * @ORM\Entity(repositoryClass="App\Infrastructure\Persistence\Doctrine\Repository\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task
{
    /**
     * @ORM\Column(name="name")
     */
    private string $name;

    /**
     * @ORM\Column(name="date")
     */
    private DateTimeImmutable $date;

    /**
     * @ORM\Column(name="duration")
     */
    private int $duration;

    /**
     * Task constructor.
     *
     * @param string             $name
     * @param DateTimeImmutable $date
     * @param int                $duration
     */
    public function __construct(string $name, DateTimeImmutable $date, int $duration)
    {
        $this->name     = $name;
        $this->date     = $date;
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return DateTimeImmutable
     */
    public function date(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function duration(): int
    {
        return $this->duration;
    }

    /**
     * Increase time duration of an existing task.
     *
     * @param int $duration
     */
    public function increaseDuration(int $duration): void
    {
        $this->duration += $duration;
    }
}
