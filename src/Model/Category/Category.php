<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Category;


use Sphere\Core\Model\Common\JsonObject;

class Category extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'slug' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'description' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'ancestors' => [self::TYPE => '\Sphere\Core\Model\Category\CategoryReferenceCollection'],
            'parent' => [self::TYPE => '\Sphere\Core\Model\Category\CategoryReference'],
            'orderHint' => [self::TYPE => 'string'],
            'externalId' => [self::TYPE => 'string'],
        ];
    }
}
