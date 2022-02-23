<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#producttypedraft
 * @method string getName()
 * @method ProductTypeDraft setName(string $name = null)
 * @method string getDescription()
 * @method ProductTypeDraft setDescription(string $description = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductTypeDraft setAttributes(AttributeDefinitionCollection $attributes = null)
 * @method string getKey()
 * @method ProductTypeDraft setKey(string $key = null)
 */
class ProductTypeDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string', static::OPTIONAL => true],
            'description' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => AttributeDefinitionCollection::class, static::OPTIONAL => true],
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
