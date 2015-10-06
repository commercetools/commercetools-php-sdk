<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Type\FieldDefinitionCollection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @method AttributeDefinition current()
 * @method AttributeDefinitionCollection add(AttributeDefinition $element)
 * @method AttributeDefinition getAt($offset)
 */
class AttributeDefinitionCollection extends FieldDefinitionCollection
{
    protected $type = '\Commercetools\Core\Model\ProductType\AttributeDefinition';
}
