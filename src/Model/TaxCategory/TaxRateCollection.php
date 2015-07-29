<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\Collection;

/**
 * @package Sphere\Core\Model\TaxCategory
 * 
 * @method TaxRate current()
 * @method TaxRate getAt($offset)
 */
class TaxRateCollection extends Collection
{
    protected $type = '\Sphere\Core\Model\TaxCategory\TaxRate';
}
