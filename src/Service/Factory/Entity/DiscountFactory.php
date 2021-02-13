<?php

declare(strict_types=1);

namespace App\Service\Factory\Entity;

use App\Entity\Discount;
use Carbon\Carbon;

/**
 * Class DiscountFactory
 *
 * @package App\Service\Factory\Entity
 */
class DiscountFactory
{
    private int $defaultExpiry;

    /**
     * DiscountFactory constructor.
     *
     * @param int $defaultExpiry
     */
    public function __construct(int $defaultExpiry)
    {
        $this->defaultExpiry = $defaultExpiry;
    }

    /**
     * @return Discount
     */
    public function createDiscount(): Discount
    {
        return (new Discount)
            ->setExpiresAt(Carbon::now()->addMinutes($this->defaultExpiry));
    }
}
