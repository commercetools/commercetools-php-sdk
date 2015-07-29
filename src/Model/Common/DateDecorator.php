<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * @package Sphere\Core\Model\Common
 */
class DateDecorator extends DateTimeDecorator
{
    public function jsonSerialize()
    {
        return $this->getUtcDateTime()->format('Y-m-d');
    }
}
