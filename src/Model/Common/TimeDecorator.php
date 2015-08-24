<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 */
class TimeDecorator extends DateTimeDecorator
{
    public function jsonSerialize()
    {
        return $this->getDateTime()->format('H:i:s');
    }
}
