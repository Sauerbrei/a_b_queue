<?php

declare(strict_types=1);

namespace App\Service\Factory\Entity;

use App\Entity\User;

/**
 * Class UserFactory
 *
 * @package App\Service\Factory\Entity
 */
class UserFactory
{
    /**
     * @return User
     */
    public static function createUser(): User
    {
        return new User;
    }
}
