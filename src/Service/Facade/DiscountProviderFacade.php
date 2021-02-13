<?php

declare(strict_types=1);

namespace App\Service\Facade;

use App\Entity\User;
use App\Manager\DiscountManager;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Exception;

/**
 * Class DiscountProviderFacade
 *
 * @package App\Service\Facade
 */
class DiscountProviderFacade
{
    /**
     * @var DiscountManager
     */
    private DiscountManager $discountManager;
    /**
     * @var int
     */
    private int $defaultExpiry;

    /**
     * DiscountProviderFacade constructor.
     *
     * @param DiscountManager $discountManager
     * @param int             $defaultExpiry
     */
    public function __construct(DiscountManager $discountManager, int $defaultExpiry)
    {
        $this->discountManager = $discountManager;
        $this->defaultExpiry = $defaultExpiry;
    }

    /**
     * @param int  $amount
     * @param User $user
     *
     * @return Collection
     * @throws Exception
     */
    public function registerDiscounts(int $amount, User $user): Collection
    {
        $discountList = $this->discountManager->findValidCoupons($amount);
        $expiration = (new DateTime)->add(new DateInterval('PT' . $this->defaultExpiry . 'M'));
        foreach ($discountList as $discount) {
            $discount
                ->setExpiresAt($expiration)
                ->setUser($user);
            $this->discountManager->save($discount);
        }
        return $discountList;
    }
}
