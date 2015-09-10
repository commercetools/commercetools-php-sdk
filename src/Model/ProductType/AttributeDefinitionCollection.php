<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @method AttributeDefinition current()
 * @method AttributeDefinitionCollection add(AttributeDefinition $element)
 * @method AttributeDefinition getAt($offset)
 */
class AttributeDefinitionCollection extends Collection
{
    const NAME = 'name';

    protected $type = '\Commercetools\Core\Model\ProductType\AttributeDefinition';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof AttributeDefinition) {
            $name = $row->getName();
        } else {
            $name = $row[static::NAME];
        }
        $this->addToIndex(static::NAME, $offset, $name);
    }

    /**
     * @param $attributeName
     * @return AttributeDefinition|null
     */
    public function getByName($attributeName)
    {
        return $this->getBy(static::NAME, $attributeName);
    }
}
