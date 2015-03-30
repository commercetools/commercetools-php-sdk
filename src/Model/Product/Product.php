<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 09.02.15, 10:48
 */

namespace Sphere\Core\Model\Product;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\ProductType\ProductTypeReference;
use Sphere\Core\Model\TaxCategory\TaxCategory;

/**
 * Class Product
 * @package Sphere\Core\Model\Product
 * @method string getId()
 * @method Product setId(string $id = null)
 * @method int getVersion()
 * @method Product setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Product setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Product setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method ProductTypeReference getProductType()
 * @method Product setProductType(ProductTypeReference $productType = null)
 * @method TaxCategory getTaxCategory()
 * @method Product setTaxCategory(TaxCategory $taxCategory = null)
 * @method ProductCatalogData getMasterData()
 * @method Product setMasterData(ProductCatalogData $masterData = null)
 */
class Product extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE  => '\DateTime'],
            'productType' => [static::TYPE => '\Sphere\Core\Model\ProductType\ProductTypeReference'],
            'taxCategory' => [self::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategory'],
            'masterData' => [self::TYPE => '\Sphere\Core\Model\Product\ProductCatalogData']
        ];
    }
}
