<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper;

interface CurrencyFormatterInterface
{
    /**
     * @param $centAmount
     * @param $currency
     * @return string
     */
    public function format($centAmount, $currency);
}
