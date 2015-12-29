<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Category
 * @method CategoryReference current()
 * @method CategoryReferenceCollection add(CategoryReference $element)
 * @method CategoryReference getAt($offset)
 */
class CategoryReferenceCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Category\CategoryReference';
}
