<?php

declare(strict_types=1);

namespace App\Manager;

use App\Repository\DiscountRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DiscountManager
 *
 * @package App\Manager
 */
class DiscountManager extends AbstractManager
{
    /**
     * @var DiscountRepository
     */
    private DiscountRepository $discountRepository;

    /**
     * DiscountManager constructor.
     *
     * @param EntityManagerInterface $doctrine
     * @param DiscountRepository     $discountRepository
     */
    public function __construct(EntityManagerInterface $doctrine, DiscountRepository $discountRepository)
    {
        parent::__construct($doctrine);
        $this->discountRepository = $discountRepository;
    }
}
