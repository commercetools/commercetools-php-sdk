<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method TriggerCollection add(Trigger $element)
 * @method Trigger current()
 * @method Trigger getAt($offset)
 */
class TriggerCollection extends Collection
{
    protected $type = Trigger::class;
}
