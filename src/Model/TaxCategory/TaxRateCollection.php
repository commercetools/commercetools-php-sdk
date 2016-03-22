<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#tax-rate
 * @method TaxRate current()
 * @method TaxRateCollection add(TaxRate $element)
 * @method TaxRate getAt($offset)
 */
class TaxRateCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\TaxCategory\TaxRate';
}
