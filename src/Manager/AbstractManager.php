<?php

declare(strict_types=1);

namespace App\Manager;

use App\Interfaces\Manager\ManagerInterface;
use App\Interfaces\Model\PresenceInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AbstractManager
 *
 * @package App\Manager
 */
abstract class AbstractManager implements ManagerInterface
{
    private EntityManagerInterface $doctrine;

    /**
     * AbstractManager constructor.
     *
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(EntityManagerInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param PresenceInterface $entity
     * @param bool              $flush
     */
    public function save(PresenceInterface $entity, bool $flush = true): void
    {
        $this->doctrine->persist($entity);
        if ($flush === true) {
            $this->doctrine->flush();
        }
    }
}
