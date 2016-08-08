<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method AssetCollection add(Asset $element)
 * @method Asset current()
 * @method Asset getAt($offset)
 */
class AssetCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Asset';
}
