<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Category
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-categories.html#category
 * @method CategoryReference current()
 * @method CategoryReferenceCollection add(CategoryReference $element)
 * @method CategoryReference getAt($offset)
 * @method CategoryReference getById($offset)
 */
class CategoryReferenceCollection extends Collection
{
    protected $type = CategoryReference::class;
}
