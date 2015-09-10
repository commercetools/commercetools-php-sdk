<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


/**
 * @package Commercetools\Core\Model\Common
 * @method Price current()
 * @method PriceCollection add(Price $element)
 * @method Price getAt($offset)
 */
class PriceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Common\Price';
}
