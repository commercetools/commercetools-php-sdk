<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://dev.commercetools.com/http-api-projects-taxCategories.html#taxcategory
 * @method string getId()
 * @method TaxCategory setId(string $id = null)
 * @method int getVersion()
 * @method TaxCategory setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method TaxCategory setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method TaxCategory setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method TaxCategory setName(string $name = null)
 * @method string getDescription()
 * @method TaxCategory setDescription(string $description = null)
 * @method TaxRateCollection getRates()
 * @method TaxCategory setRates(TaxRateCollection $rates = null)
 * @method TaxCategoryReference getReference()
 */
class TaxCategory extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [self::TYPE => 'string'],
            'version' => [self::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'name' => [self::TYPE => 'string'],
            'description' => [self::TYPE => 'string'],
            'rates' => [self::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxRateCollection']
        ];
    }
}
