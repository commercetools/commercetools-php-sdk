<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\Document;

/**
 * Class TaxCategory
 * @package Sphere\Core\Model\TaxCategory
 * @link http://dev.sphere.io/http-api-projects-taxCategories.html#tax-category
 * @method string getId()
 * @method TaxCategory setId(string $id = null)
 * @method int getVersion()
 * @method TaxCategory setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method TaxCategory setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method TaxCategory setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method TaxCategory setName(string $name = null)
 * @method string getDescription()
 * @method TaxCategory setDescription(string $description = null)
 * @method Collection getRates()
 * @method TaxCategory setRates(Collection $rates = null)
 */
class TaxCategory extends Document
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
            'rates' => [self::TYPE => '\Sphere\Core\Model\TaxCategory\TaxRateCollection']
        ];
    }
}
