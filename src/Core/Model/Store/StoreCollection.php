<?php
/**
 */

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-projects-stores#stores
 * @method StoreCollection add(Store $element)
 * @method Store current()
 * @method Store getAt($offset)
 * @method Store getById($offset)
 */
class StoreCollection extends Collection
{
    protected $type = Store::class;
}
