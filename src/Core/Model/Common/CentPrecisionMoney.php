<?php
/**
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getCurrencyCode()
 * @method CentPrecisionMoney setCurrencyCode(string $currencyCode = null)
 * @method int getCentAmount()
 * @method CentPrecisionMoney setCentAmount(int $centAmount = null)
 * @method string getType()
 * @method CentPrecisionMoney setType(string $type = null)
 * @method int getFractionDigits()
 * @method CentPrecisionMoney setFractionDigits(int $fractionDigits = null)
 */
class CentPrecisionMoney extends Money
{
    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        $data[static::TYPE] = static::TYPE_CENT_PRECISION;
        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            static::CURRENCY_CODE => [self::TYPE => 'string'],
            static::CENT_AMOUNT => [self::TYPE => 'int'],
            static::TYPE => [self::TYPE => 'string'],
            static::FRACTION_DIGITS => [self::TYPE => 'int']
        ];
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
        return $money->setCurrencyCode($currencyCode)
            ->setCentAmount($centAmount);
    }
}
