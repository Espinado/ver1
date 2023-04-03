<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatus extends Enum
{
    const pending = 0;
    const confirmed = 1;
    const shipped = 2;
    const processing=3;
    const picked=4;
    const delivered =5;


}
