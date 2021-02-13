<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @return Collection&User[]
     */
    public function getAllUsers(): Collection
    {
        $userList = $this->userRepository->findAll();
        return new ArrayCollection($userList);
    }
}
