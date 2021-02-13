<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Discount;
use DateTime;
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

    /**
     * @param int $amount
     *
     * @return array&Discount[]
     */
    public function findNewValidCoupons(int $amount): array
    {
        $queryBuilder = $this->createQueryBuilder('d');
        $queryBuilder
            ->select('d')
            ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq('d.used', ':used'),
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->isNull('d.expiresAt'),
                        $queryBuilder->expr()->lte('d.expiresAt', ':now')
                    )
                )
            )
            ->setParameter('used', false)
            ->setParameter('now', new DateTime)
            ->setMaxResults($amount);

        return $queryBuilder->getQuery()->getResult();
    }
}
