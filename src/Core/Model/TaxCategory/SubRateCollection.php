<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#subrate
 * @method SubRateCollection add(SubRate $element)
 * @method SubRate current()
 * @method SubRate getAt($offset)
 */
class SubRateCollection extends Collection
{
    protected $type = SubRate::class;
}
