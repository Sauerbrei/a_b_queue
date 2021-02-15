<?php

declare(strict_types=1);

namespace App\Service\Facade;

use App\Entity\Discount;
use App\Entity\User;
use App\Exception\Model\DiscountAlreadyUsedException;
use App\Exception\Model\DiscountExpiredException;
use App\Manager\DiscountManager;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;
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
        $discountList = $this->discountManager->getNewValidDiscounts($amount);
        $expiration = (new DateTime)->add(new DateInterval('PT'.$this->defaultExpiry.'M'));
        foreach ($discountList as $discount) {
            $discount
                ->setExpiresAt($expiration)
                ->setUser($user);
            $this->discountManager->save($discount);
        }

        return $discountList;
    }

    /**
     * @param Discount $discount
     *
     * @return bool
     * @throws EntityNotFoundException
     * @throws DiscountAlreadyUsedException
     * @throws DiscountExpiredException
     */
    public function claimDiscount(Discount $discount): bool
    {
        $discountEntity = $this->discountManager->getDiscount($discount->getId());
        if ($discountEntity->isPresent() === false) {
            throw new EntityNotFoundException('The requested discount is unavailable');
        }
        if ($discountEntity->isUsed() === true) {
            throw new DiscountAlreadyUsedException('The requested discount is already used');
        }
        if ($discountEntity->isExpired() === true) {
            throw new DiscountExpiredException('Sorry mate, but this discount seems to be used :(');
        }
        // ToDo Check if selected discount belongs to the user who requests the claim
        $discount->setUsed(true);
        // fire event
        $this->discountManager->save($discount);

        return true;
    }
}
