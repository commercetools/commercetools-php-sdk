<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class Product
 * @package Sphere\Core\Model\Product
 * @method LocalizedString getName()
 * @method Product setName(LocalizedString $name)
 * @method LocalizedString getDescription()
 * @method Product setDescription(LocalizedString $description)
 * @method array getMasterVariant()
 * @method Product setMasterVariant(array $masterVariant)
 */
class Product extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'description' => [self::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
            'masterVariant' => [self::TYPE => 'array']
        ];
    }
}
