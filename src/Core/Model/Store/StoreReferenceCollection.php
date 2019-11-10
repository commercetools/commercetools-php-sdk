<?php

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Store
 *
 * @link https://docs.commercetools.com/http-api-types.html#reference-types
 * @link https://docs.commercetools.com/http-api-projects-stores#stores
 * @method StoreReferenceCollection add(StoreReference $element)
 * @method StoreReference current()
 * @method StoreReference getAt($offset)
 * @method StoreReference getById($offset)
 */
class StoreReferenceCollection extends Collection
{
    protected $type = StoreReference::class;
}
