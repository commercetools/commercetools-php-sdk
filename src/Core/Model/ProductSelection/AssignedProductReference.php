<?php

namespace Commercetools\Core\Model\ProductSelection;

use Commercetools\Core\Model\Common\CreatedBy;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\LastModifiedBy;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\ReferenceCollection;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Product\ProductReference;
use DateTime;

/**
 * @package Commercetools\Core\Model\ProductSelection
 * @link https://docs.commercetools.com/http-api-projects-productSelections.html#productselection
 * @method string getId()
 * @method ProductSelection setId(string $id = null)
 * @method int getVersion()
 * @method ProductSelection setVersion(int $version = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method ProductSelection setCreatedAt(DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method ProductSelection setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method ProductSelection setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method ProductSelection setDescription(LocalizedString $description = null)
 * @method mixed getPredicate()
 * @method ProductSelection setPredicate($predicate = null)
 * @method string getSortOrder()
 * @method ProductSelection setSortOrder(string $sortOrder = null)
 * @method bool getIsActive()
 * @method ProductSelection setIsActive(bool $isActive = null)
 * @method ReferenceCollection getReferences()
 * @method ProductSelection setReferences(ReferenceCollection $references = null)
 * @method DateTimeDecorator getValidFrom()
 * @method ProductSelection setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method ProductSelection setValidUntil(DateTime $validUntil = null)
 * @method CreatedBy getCreatedBy()
 * @method ProductSelection setCreatedBy(CreatedBy $createdBy = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method ProductSelection setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 * @method string getKey()
 * @method ProductSelection setKey(string $key = null)
 * @method int getProductCount()
 * @method ProductSelection setProductCount(int $productCount = null)
 * @method ProductReference getProduct()
 * @method AssignedProductReference setProduct(ProductReference $product = null)
 * @method ProductSelectionReference getProductSelection()
 * @method AssignedProductReference setProductSelection(ProductSelectionReference $productSelection = null)
 */
class AssignedProductReference extends Resource
{
    public function fieldDefinitions()
    {
        return [
            'product' => [static::TYPE => ProductReference::class],
        ];
    }
}
