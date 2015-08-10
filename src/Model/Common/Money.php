<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:44
 */

namespace Commercetools\Core\Model\Common;


/**
 * @package Commercetools\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-types.html#money
 * @method string getCurrencyCode()
 * @method int getCentAmount()
 * @method Money setCurrencyCode(string $currencyCode = null)
 * @method Money setCentAmount(int $centAmount = null)
 */
class Money extends JsonObject
{
    const CURRENCY_CODE = 'currencyCode';
    const CENT_AMOUNT = 'centAmount';

    public function getPropertyDefinitions()
    {
        return [
            static::CURRENCY_CODE => [self::TYPE => 'string'],
            static::CENT_AMOUNT => [self::TYPE => 'int'],
        ];
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getContext()->getCurrencyFormatter()->format($this->getCentAmount(), $this->getCurrencyCode());
    }

    /**
     * @param $currencyCode
     * @param $centAmount
     * @param Context|callable $context
     * @return Money
     */
    public static function ofCurrencyAndAmount($currencyCode, $centAmount, $context = null)
    {
        $money = static::of($context);
        return $money->setCurrencyCode($currencyCode)->setCentAmount($centAmount);
    }
}
