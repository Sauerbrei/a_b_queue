<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Discount;
use App\Repository\DiscountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @param int $amount
     *
     * @return Collection&iterable&Discount[]
     */
    public function findValidCoupons(int $amount): Collection
    {
        $result = $this->discountRepository->findNewValidCoupons($amount);

        return new ArrayCollection($result);
    }
}
