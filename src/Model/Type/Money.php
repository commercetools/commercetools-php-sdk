<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:44
 */

namespace Sphere\Core\Model\Type;

use Sphere\Core\Model\OfTrait;

/**
 * Class Money
 * @package Sphere\Core\Model\Type
 * @method static Money of(string $currencyCode, int $centAmount)
 * @method string getCurrencyCode()
 * @method int getCentAmount()
 * @method Money setCurrencyCode(string $currencyCode)
 * @method Money setCentAmount(int $centAmount)
 */
class Money extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'currencyCode' => [self::TYPE => 'string'],
            'centAmount' => [self::TYPE => 'int'],
        ];
    }

    /**
     * @param string $currencyCode
     * @param int $centAmount
     */
    public function __construct($currencyCode, $centAmount)
    {
        $this->setCurrencyCode($currencyCode);
        $this->setCentAmount($centAmount);
    }
}
