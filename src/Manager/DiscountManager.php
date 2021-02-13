<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Discount;
use App\Entity\User;
use App\Repository\DiscountRepository;
use App\Service\Factory\Entity\DiscountFactory;
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
     * @param int $discountId
     *
     * @return Discount
     */
    public function getDiscount(int $discountId): Discount
    {
        $discount = $this->discountRepository->find($discountId);
        if ($discount instanceof Discount === false) {
            return DiscountFactory::createDiscount();
        }

        return $discount;
    }

    /**
     * @param User $user
     *
     * @return Collection&iterable&Discount[]
     */
    public function getRegisteredDiscounts(User $user): Collection
    {
        $result = $this->discountRepository->getRegisteredDiscounts($user);

        return new ArrayCollection($result);
    }

    /**
     * @param int $amount
     *
     * @return Collection&iterable&Discount[]
     */
    public function getNewValidDiscounts(int $amount): Collection
    {
        $result = $this->discountRepository->getNewValidDiscounts($amount);

        return new ArrayCollection($result);
    }
}
