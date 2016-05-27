<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\TaxCategory
 *
 * @method SubRateCollection add(SubRate $element)
 * @method SubRate current()
 * @method SubRate getAt($offset)
 */
class SubRateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\TaxCategory\SubRate';
}
