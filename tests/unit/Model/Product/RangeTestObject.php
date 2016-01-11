<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

class RangeTestObject
{
    protected $value;
    protected $quotes;

    public function __construct($value, $quotes = '')
    {
        $this->value = $value;
        $this->quotes = $quotes;
    }

    public function __toString()
    {
        return $this->quotes . $this->value . $this->quotes;
    }
}
