<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\TaxCategory;

use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\TaxCategory
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#taxcategory
 * @method string getId()
 * @method TaxCategory setId(string $id = null)
 * @method int getVersion()
 * @method TaxCategory setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method TaxCategory setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method TaxCategory setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method TaxCategory setName(string $name = null)
 * @method string getDescription()
 * @method TaxCategory setDescription(string $description = null)
 * @method TaxRateCollection getRates()
 * @method TaxCategory setRates(TaxRateCollection $rates = null)
 * @method string getKey()
 * @method TaxCategory setKey(string $key = null)
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
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'name' => [self::TYPE => 'string'],
            'description' => [self::TYPE => 'string'],
            'rates' => [self::TYPE => TaxRateCollection::class],
            'key' => [self::TYPE => 'string'],
        ];
    }
}
