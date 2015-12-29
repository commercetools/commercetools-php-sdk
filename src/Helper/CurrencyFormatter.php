<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper;

use Commercetools\Core\Model\Common\Context;

/**
 * Formats a given currency for display. As default the intl extensions capabilities are used for formatting.
 * Given the locale of the context and the currency, the amount will be formatted with intl NumberFormatter.
 * The formatter reads the fraction digits from the formatter for the given currency and locale. This information
 * is used to calculate the currency value from the centAmount
 *
 * Example:
 * $centAmount = 123456;
 * $currency = 'JPY';
 * $str = $this->format($centAmount, $currency); // '¥123,456'
 * $currency = 'USD';
 * $str = $this->format($centAmount, $currency); // '$1,234.56'
 * $currency = 'EUR';
 * $str = $this->format($centAmount, $currency); // '1.234,56 €'
 * @package Commercetools\Core\Helper
 */
class CurrencyFormatter
{
    protected $context;

    protected $formatCallback;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param $centAmount
     * @param $currency
     * @return string
     */
    protected function defaultFormat($centAmount, $currency)
    {
        $locale = $this->context->getLocale();
        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        $fractionUnits = pow(10, $formatter->getAttribute(\NumberFormatter::FRACTION_DIGITS));
        $amount = $centAmount / $fractionUnits;
        $currency = strtoupper($currency);

        return $formatter->formatCurrency($amount, $currency);
    }

    /**
     * @param callable $formatCallback
     */
    public function setFormatCallback(callable $formatCallback)
    {
        $this->formatCallback = $formatCallback;
    }

    /**
     * @param int $centAmount
     * @param string $currency
     * @return string
     */
    public function format($centAmount, $currency)
    {
        if (is_null($this->formatCallback)) {
            return $this->defaultFormat($centAmount, $currency);
        }
        return call_user_func_array($this->formatCallback, [$centAmount, $currency]);
    }
}
