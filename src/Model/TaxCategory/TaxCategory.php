<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\JsonObject;

/**
 * Class TaxCategory
 * @package Sphere\Core\Model\TaxCategory
 * @method string getId()
 * @method TaxCategory setId(string $id)
 * @method int getVersion()
 * @method TaxCategory setVersion(int $version)
 * @method \DateTime getCreatedAt()
 * @method TaxCategory setCreatedAt(\DateTime $createdAt)
 * @method \DateTime getLastModifiedAt()
 * @method TaxCategory setLastModifiedAt(\DateTime $lastModifiedAt)
 * @method string getName()
 * @method TaxCategory setName(string $name)
 * @method string getDescription()
 * @method TaxCategory setDescription(string $description)
 * @method Collection getRates()
 * @method TaxCategory setRates(Collection $rates)
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
