<?php
/**
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-types.html#money
 * @method string getCurrencyCode()
 * @method int getCentAmount()
 * @method HighPrecisionMoney setCurrencyCode(string $currencyCode = null)
 * @method HighPrecisionMoney setCentAmount(int $centAmount = null)
 * @method string getType()
 * @method HighPrecisionMoney setType(string $type = null)
 * @method int getFractionDigits()
 * @method HighPrecisionMoney setFractionDigits(int $fractionDigits = null)
 * @method int getPreciseAmount()
 * @method HighPrecisionMoney setPreciseAmount(int $preciseAmount = null)
 * @method string getHighPrecision()
 * @method HighPrecisionMoney setHighPrecision(string $highPrecision = null)
 */
class HighPrecisionMoney extends Money
{
    const PRECISE_AMOUNT = 'preciseAmount';

    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        $data[static::TYPE] = static::TYPE_HIGH_PRECISION;
        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            static::CURRENCY_CODE => [self::TYPE => 'string'],
            static::CENT_AMOUNT => [self::TYPE => 'int'],
            static::TYPE => [self::TYPE => 'string'],
            static::FRACTION_DIGITS => [self::TYPE => 'int'],
            static::PRECISE_AMOUNT => [self::TYPE => 'int'],
        ];
    }

    /**
     * @param string $currencyCode
     * @param int $amount
     * @param int $fractionDigits
     * @param Context|callable $context
     * @return HighPrecisionMoney
     */
    public static function ofCurrencyAmountAndFraction($currencyCode, $amount, $fractionDigits, $context = null)
    {
        $money = static::of($context);
        return $money->setCurrencyCode($currencyCode)
            ->setPreciseAmount($amount)
            ->setFractionDigits($fractionDigits);
    }

    /**
     * @param $currencyCode
     * @param $centAmount
     * @param Context|callable $context
     * @return HighPrecisionMoney|Money
     */
    public static function ofCurrencyAndAmount($currencyCode, $centAmount, $context = null)
    {
        $money = static::of($context);
        return $money->setCurrencyCode($currencyCode)
            ->setPreciseAmount($centAmount)
            ->setFractionDigits(2);
    }
}
