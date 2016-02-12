<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\ProductType\ProductTypeReference;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Review\ReviewRatingStatistics;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products.html#product
 * @method string getId()
 * @method Product setId(string $id = null)
 * @method int getVersion()
 * @method Product setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method Product setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method Product setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method ProductTypeReference getProductType()
 * @method Product setProductType(ProductTypeReference $productType = null)
 * @method TaxCategory getTaxCategory()
 * @method Product setTaxCategory(TaxCategory $taxCategory = null)
 * @method ProductCatalogData getMasterData()
 * @method Product setMasterData(ProductCatalogData $masterData = null)
 * @method ReviewRatingStatistics getReviewRatingStatistics()
 * @method Product setReviewRatingStatistics(ReviewRatingStatistics $reviewRatingStatistics = null)
 * @method StateReference getState()
 * @method Product setState(StateReference $state = null)
 */
class Product extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'lastModifiedAt' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            'productType' => [static::TYPE => '\Commercetools\Core\Model\ProductType\ProductTypeReference'],
            'taxCategory' => [self::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategory'],
            'masterData' => [self::TYPE => '\Commercetools\Core\Model\Product\ProductCatalogData'],
            'reviewRatingStatistics' => [static::TYPE => '\Commercetools\Core\Model\Review\ReviewRatingStatistics'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
        ];
    }
}
