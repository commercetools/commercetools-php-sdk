<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\TaxCategory
 *
 * @method TaxRate current()
 * @method TaxRateCollection add(TaxRate $element)
 * @method TaxRate getAt($offset)
 */
class TaxRateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\TaxCategory\TaxRate';
}
