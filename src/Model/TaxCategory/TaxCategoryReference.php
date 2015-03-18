<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Reference;
use Sphere\Core\Model\Common\ReferenceFromArrayTrait;

/**
 * Class TaxCategoryReference
 * @package Sphere\Core\Model\TaxCategory
 * @method static TaxCategoryReference of(string $id)
 * @method string getTypeId()
 * @method TaxCategoryReference setTypeId(string $typeId)
 * @method string getId()
 * @method TaxCategoryReference setId(string $id)
 * @method array getObj()
 * @method TaxCategoryReference setObj(array $obj)
 */
class TaxCategoryReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_TAX_CATEGORY = 'tax-category';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(static::TYPE_TAX_CATEGORY, $id, $context);
    }
}
