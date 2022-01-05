<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/http-api-projects-productSelections.html#productselection
 * @method ProductSelection current()
 * @method ProductSelectionCollection add(ProductSelection $element)
 * @method ProductSelection getAt($offset)
 * @method ProductSelection getById($offset)
 */
class ProductSelectionCollection extends Collection
{
    protected $type = ProductSelection::class;
}
