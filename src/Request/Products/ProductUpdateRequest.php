<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 05.02.15, 17:26
 */

namespace Sphere\Core\Request\Products;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Image;
use Sphere\Core\Model\Product\LocalizedSearchKeywords;
use Sphere\Core\Model\Product\ProductVariantDraft;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;
use Sphere\Core\Model\Common\Attribute;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\Price;
use Sphere\Core\Request\AbstractUpdateRequest;
use Sphere\Core\Request\Products\Command\ProductAddExternalImageAction;
use Sphere\Core\Request\Products\Command\ProductAddPriceAction;
use Sphere\Core\Request\Products\Command\ProductAddToCategoryAction;
use Sphere\Core\Request\Products\Command\ProductAddVariantAction;
use Sphere\Core\Request\Products\Command\ProductChangeNameAction;
use Sphere\Core\Request\Products\Command\ProductChangePriceAction;
use Sphere\Core\Request\Products\Command\ProductChangeSlugAction;
use Sphere\Core\Request\Products\Command\ProductPublishAction;
use Sphere\Core\Request\Products\Command\ProductRemoveFromCategoryAction;
use Sphere\Core\Request\Products\Command\ProductRemoveImageAction;
use Sphere\Core\Request\Products\Command\ProductRemovePriceAction;
use Sphere\Core\Request\Products\Command\ProductRemoveVariantAction;
use Sphere\Core\Request\Products\Command\ProductRevertStagedChangesAction;
use Sphere\Core\Request\Products\Command\ProductSetAttributeAction;
use Sphere\Core\Request\Products\Command\ProductSetAttributeInAllVariantsAction;
use Sphere\Core\Request\Products\Command\ProductSetDescriptionAction;
use Sphere\Core\Request\Products\Command\ProductSetMetaAttributesAction;
use Sphere\Core\Request\Products\Command\ProductSetSearchKeywordsAction;
use Sphere\Core\Request\Products\Command\ProductSetSKUAction;
use Sphere\Core\Request\Products\Command\ProductSetTaxCategoryAction;
use Sphere\Core\Request\Products\Command\ProductUnpublishAction;

/**
 * Class ProductUpdateRequest
 * @package Sphere\Core\Request\Products
 * @link http://dev.sphere.io/http-api-projects-products.html#update-product
 */
class ProductUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Product\Product';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
