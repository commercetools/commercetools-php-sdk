<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper;


use Sphere\Core\Model\Common\Context;

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
        $amount = $centAmount / 100;
        $currency = mb_strtoupper($currency);
        $locale = $this->context->getLocale();

        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
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
