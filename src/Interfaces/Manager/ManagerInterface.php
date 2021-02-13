<?php

declare(strict_types=1);

namespace App\Interfaces\Manager;

use App\Interfaces\Model\PresenceInterface;

/**
 * Interface ManagerInterface
 *
 * @package App\Interfaces\Manager
 */
interface ManagerInterface
{
    /**
     * @param PresenceInterface $entity
     */
    public function save(PresenceInterface $entity): void;
}
