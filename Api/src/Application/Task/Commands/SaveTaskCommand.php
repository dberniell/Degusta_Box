<?php
declare(strict_types=1);

namespace App\Application\Task\Commands;

/**
 * Class SaveTaskCommand. Saves a task or updates it.
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
class SaveTaskCommand
{

    private string $name;

    private string $date;

    private int $duration;

    /**
     * SaveTaskCommand constructor.
     *
     * @param string $name
     * @param string $date
     * @param int    $duration
     */
    public function __construct(string $name, string $date, int $duration)
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
     * @return string
     */
    public function date(): string
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
}
