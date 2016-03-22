<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#attribute-definition
 * @method AttributeDefinition current()
 * @method AttributeDefinitionCollection add(AttributeDefinition $element)
 * @method AttributeDefinition getAt($offset)
 */
class AttributeDefinitionCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\ProductType\AttributeDefinition';

    const NAME = 'name';

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
     * @param $name
     * @return AttributeDefinition
     */
    public function getByName($name)
    {
        return $this->getBy(static::NAME, $name);
    }
}
