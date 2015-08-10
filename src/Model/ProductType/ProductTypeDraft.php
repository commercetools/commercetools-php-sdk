<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\ProductType
 * @apidoc http://dev.sphere.io/http-api-projects-productTypes.html#create-product-type
 * @method string getName()
 * @method ProductTypeDraft setName(string $name = null)
 * @method string getDescription()
 * @method ProductTypeDraft setDescription(string $description = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductTypeDraft setAttributes(AttributeDefinitionCollection $attributes = null)
 */
class ProductTypeDraft extends JsonObject
{
    public function getPropertyDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => '\Commercetools\Core\Model\ProductType\AttributeDefinitionCollection'],
        ];
    }

    /**
     * @param string $name
     * @param string $description
     * @param Context|callable $context
     * @return ProductTypeDraft
     */
    public static function ofNameAndDescription($name, $description, $context = null)
    {
        $draft = static::of($context);
        return $draft->setName($name)->setDescription($description);
    }
}
