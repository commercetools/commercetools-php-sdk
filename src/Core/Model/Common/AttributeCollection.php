<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\ProductType\AttributeDefinitionCollection;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#attribute
 * @method Attribute current()
 * @method AttributeCollection add(Attribute $element)
 */
class AttributeCollection extends Collection
{
    const NAME = 'name';

    protected $type = Attribute::class;

    /**
     * @var AttributeDefinitionCollection
     */
    protected $attributeDefinitions;

    protected function indexRow($offset, $row)
    {
        if ($row instanceof Attribute) {
            $name = $row->getName();
        } else {
            $name = $row[static::NAME];
        }
        $this->addToIndex(static::NAME, $offset, $name);
    }

    public function __get($attributeName)
    {
        $attribute = $this->getByName($attributeName);
        if (!is_null($attribute)) {
            return $attribute->getValue();
        }

        return null;
    }

    public function __call($name, $arguments)
    {
        if (strpos($name, 'get') === 0) {
            $name = lcfirst(substr($name, 3));
        }
        return $this->getByName($name);
    }


    public function offsetGet($offset)
    {
        if (is_string($offset)) {
            return $this->getByName($offset);
        }
        return $this->getAt($offset);
    }

    /**
     * @param $attributeName
     * @return Attribute|null
     */
    public function getByName($attributeName)
    {
        return $this->getBy(static::NAME, $attributeName);
    }

    /**
     * @param AttributeDefinitionCollection $attributeDefinitions
     * @return $this
     */
    public function setAttributeDefinitions(AttributeDefinitionCollection $attributeDefinitions)
    {
        $this->attributeDefinitions = $attributeDefinitions;

        return $this;
    }

    /**
     * @param $offset
     * @return Attribute
     */
    public function getAt($offset)
    {
        /**
         * @var Attribute $attribute;
         */
        $attribute = parent::getAt($offset);
        if (!is_null($this->attributeDefinitions)) {
            $definition = $this->attributeDefinitions->getByName($attribute->getName());
            if (!is_null($definition)) {
                $attribute->setAttributeDefinition($definition);
            }
        }

        return $attribute;
    }
}
