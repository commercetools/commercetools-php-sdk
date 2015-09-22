<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CustomField
 *
 * @method CustomFieldObjectCollection add(CustomFieldObject $element)
 * @method CustomFieldObject current()
 * @method CustomFieldObject getAt($offset)
 */
class CustomFieldObjectCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\CustomField\CustomFieldObject';
}
