<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#product-type
 * @method ProductType current()
 * @method ProductTypeCollection add(ProductType $element)
 * @method ProductType getAt($offset)
 */
class ProductTypeCollection extends Collection
{
    const ID = 'id';
    const NAME = 'name';
    protected $type = '\Commercetools\Core\Model\ProductType\ProductType';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof ProductType) {
            $id = $row->getId();
            $name = $row->getName();
        } else {
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
            $name = isset($row[static::NAME]) ? $row[static::NAME] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
        $this->addToIndex(static::NAME, $offset, $name);
    }

    /**
     * @param $id
     * @return ProductType
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }

    /**
     * @param $name
     * @return ProductType
     */
    public function getByName($name)
    {
        return $this->getBy(static::NAME, $name);
    }
}
