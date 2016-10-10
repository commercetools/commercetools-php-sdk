<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ShippingMethod;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ShippingMethod
 * @link https://dev.commercetools.com/http-api-projects-shippingMethods.html#shippingmethod
 * @method ShippingMethod current()
 * @method ShippingMethodCollection add(ShippingMethod $element)
 * @method ShippingMethod getAt($offset)
 * @method ShippingMethod getById($offset)
 */
class ShippingMethodCollection extends Collection
{
    const NAME = 'name';

    protected $type = '\Commercetools\Core\Model\ShippingMethod\ShippingMethod';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ShippingMethod) {
            $name = $row->getName();
            $id = $row->getId();
        } else {
            $name = isset($row[static::NAME]) ? $row[static::NAME] : null;
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
        }
        if (!empty($name)) {
            $this->addToIndex(static::NAME, $offset, $name);
        }
        if (!empty($id)) {
            $this->addToIndex(static::ID, $offset, $id);
        }
    }

    /**
     * @param $name
     * @return ShippingMethod
     */
    public function getByName($name)
    {
        return $this->getBy(static::NAME, $name);
    }
}
