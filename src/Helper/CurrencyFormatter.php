<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper;

use Commercetools\Core\Model\Common\Context;

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
    protected function defaultFormatCallback($centAmount, $currency)
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
            $this->formatCallback = [$this, 'defaultFormatCallback'];
        }
        return call_user_func_array($this->formatCallback, [$centAmount, $currency]);
    }
}
