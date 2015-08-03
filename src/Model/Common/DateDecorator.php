<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 */
class DateDecorator extends DateTimeDecorator
{
    public function jsonSerialize()
    {
        return $this->getUtcDateTime()->format('Y-m-d');
    }
}
