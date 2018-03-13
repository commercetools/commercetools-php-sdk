<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#typedraft
 * @method string getKey()
 * @method TypeDraft setKey(string $key = null)
 * @method LocalizedString getName()
 * @method TypeDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method TypeDraft setDescription(LocalizedString $description = null)
 * @method array getResourceTypeIds()
 * @method TypeDraft setResourceTypeIds(array $resourceTypeIds = null)
 * @method FieldDefinitionCollection getFieldDefinitions()
 * @method TypeDraft setFieldDefinitions(FieldDefinitionCollection $fieldDefinitions = null)
 */
class TypeDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'resourceTypeIds' => [static::TYPE => 'array'],
            'fieldDefinitions' => [static::TYPE => FieldDefinitionCollection::class],
        ];
    }

    public static function ofKeyNameDescriptionAndResourceTypes(
        $key,
        LocalizedString $name,
        LocalizedString $description,
        array $resourceTypeIds,
        $context = null
    ) {
        return static::of($context)
            ->setKey($key)->setName($name)->setDescription($description)->setResourceTypeIds($resourceTypeIds);
    }
}
