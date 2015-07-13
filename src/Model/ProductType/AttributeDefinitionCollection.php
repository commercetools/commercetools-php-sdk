<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Collection;

/**
 * Class AttributeDefinitionCollection
 * @package Sphere\Core\Model\ProductType
 * @method AttributeDefinition current()
 * @method AttributeDefinition getAt($offset)
 */
class AttributeDefinitionCollection extends Collection
{
    const NAME = 'name';

    protected $type = '\Sphere\Core\Model\ProductType\AttributeDefinition';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof AttributeDefinition) {
            $name = $row->getName();
        } else {
            $name = $row[static::NAME];
        }
        $this->addToIndex(static::NAME, $offset, $name);
    }

    public function getByName($attributeName)
    {
        return $this->getBy(static::NAME, $attributeName);
    }
}
