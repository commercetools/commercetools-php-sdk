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
 * @method TaxCategoryReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method TaxCategoryReference setId(string $id = null)
 * @method TaxCategory getObj()
 * @method TaxCategoryReference setObj(TaxCategory $obj = null)
 */
class TaxCategoryReference extends Reference
{
    use ReferenceFromArrayTrait;

    const TYPE_TAX_CATEGORY = 'tax-category';

    public function getFields()
    {
        return [
            'typeId' => [self::TYPE => 'string'],
            'id' => [self::TYPE => 'string'],
            'obj' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategory']
        ];
    }

    /**
     * @param string $id
     * @param Context|callable $context
     */
    public function __construct($id, $context = null)
    {
        parent::__construct(static::TYPE_TAX_CATEGORY, $id, $context);
    }
}
