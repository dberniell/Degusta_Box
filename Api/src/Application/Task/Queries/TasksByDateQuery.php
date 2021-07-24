<?php
declare(strict_types=1);

namespace App\Application\Queries;

/**
 * Class TasksByDateQuery. Gets all tasks of a date.
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 */
class TasksByDateQuery
{

    private string $date;

    /**
     * TasksByDateQuery constructor.
     *
     * @param string $date
     */
    public function __construct(string $date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function date(): string
    {
        return $this->date;
    }
}
