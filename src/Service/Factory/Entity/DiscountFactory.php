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
    /**
     * @return Discount
     */
    public static function createDiscount(): Discount
    {
        return new Discount;
    }
}
