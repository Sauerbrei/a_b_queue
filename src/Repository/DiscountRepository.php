<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Discount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class DiscountRepository
 *
 * @package App\Repository
 */
class DiscountRepository extends ServiceEntityRepository
{
    /**
     * DiscountRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Discount::class);
    }
}
