<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Resource;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @apidoc http://dev.sphere.io/http-api-projects-taxCategories.html#tax-category
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
 * @method TaxRateCollection getRates()
 * @method TaxCategory setRates(TaxRateCollection $rates = null)
 */
class TaxCategory extends Resource
{
    public function getPropertyDefinitions()
    {
        return [
            'id' => [self::TYPE => 'string'],
            'version' => [self::TYPE => 'int'],
            'createdAt' => [self::TYPE => '\DateTime'],
            'lastModifiedAt' => [self::TYPE => '\DateTime'],
            'name' => [self::TYPE => 'string'],
            'description' => [self::TYPE => 'string'],
            'rates' => [self::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxRateCollection']
        ];
    }
}
