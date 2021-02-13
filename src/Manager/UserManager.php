<?php

declare(strict_types=1);

namespace App\Manager;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserManager
 *
 * @package App\Manager
 */
class UserManager extends AbstractManager
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserManager constructor.
     *
     * @param EntityManagerInterface $doctrine
     * @param UserRepository         $userRepository
     */
    public function __construct(EntityManagerInterface $doctrine, UserRepository $userRepository)
    {
        parent::__construct($doctrine);
        $this->userRepository = $userRepository;
    }
}
