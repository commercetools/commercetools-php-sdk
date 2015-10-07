<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @method Reference current()
 * @method ReferenceCollection add(Reference $element)
 * @method Reference getAt($offset)
 */
class ReferenceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Reference';
}
