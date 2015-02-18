<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\JsonObject;

/**
 * Class TaxCategory
 * @package Sphere\Core\Model\TaxCategory
 */
class TaxCategory extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [self::TYPE => 'string'],
            'version' => [self::TYPE => 'int'],
            'createdAt' => [self::TYPE => '\DateTime'],
            'lastModifiedAt' => [self::TYPE => '\DateTime'],
            'name' => [self::TYPE => 'string'],
            'description' => [self::TYPE => 'string'],
            'rates' => [self::TYPE => '\Sphere\Core\Model\Common\Collection']
        ];
    }
}
