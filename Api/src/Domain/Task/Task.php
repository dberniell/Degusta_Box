<?php

declare(strict_types=1);

namespace App\Domain\Task;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task Entity
 *
 * @author David Berniell Giner <davidberniell@gmail.com>
 *
 * @ORM\Entity(repositoryClass="App\Infrastructure\Persistence\Doctrine\Repositories\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task
{

}
