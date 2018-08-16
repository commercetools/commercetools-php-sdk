<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method ExtensionCollection add(Extension $element)
 * @method Extension current()
 * @method Extension getAt($offset)
 * @method Extension getById($offset)
 */
class ExtensionCollection extends Collection
{
    protected $type = Extension::class;
}
