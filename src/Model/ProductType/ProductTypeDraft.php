<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * Class ProductTypeDraft
 * @package Sphere\Core\Model\ProductType
 * @method string getName()
 * @method ProductTypeDraft setName(string $name = null)
 * @method string getDescription()
 * @method ProductTypeDraft setDescription(string $description = null)
 * @method AttributeDefinitionCollection getAttributes()
 * @method ProductTypeDraft setAttributes(AttributeDefinitionCollection $attributes = null)
 */
class ProductTypeDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'attributes' => [static::TYPE => '\Sphere\Core\Model\ProductType\AttributeDefinitionCollection'],
        ];
    }

    /**
     * @param string $name
     * @param string $description
     * @param Context|callable $context
     */
    public function __construct($name, $description, Context $context = null)
    {
        $this->setContext($context)->setName($name)->setDescription($description);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static($data['name'], $data['description'], $context);
        $draft->setRawData($data);

        return $draft;
    }
}
