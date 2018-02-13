<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#taxcategory
 * @method TaxCategory current()
 * @method TaxCategoryCollection add(TaxCategory $element)
 * @method TaxCategory getAt($offset)
 * @method TaxCategory getById($offset)
 */
class TaxCategoryCollection extends Collection
{
    protected $type = TaxCategory::class;
}
