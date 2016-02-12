<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Type\FieldDefinitionCollection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#attribute-definition
 * @method AttributeDefinition current()
 * @method AttributeDefinitionCollection add(AttributeDefinition $element)
 * @method AttributeDefinition getAt($offset)
 */
class AttributeDefinitionCollection extends FieldDefinitionCollection
{
    protected $type = '\Commercetools\Core\Model\ProductType\AttributeDefinition';
}
