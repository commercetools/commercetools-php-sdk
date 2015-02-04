<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Sphere\Core\Model\TaxCategory;

use Sphere\Core\Model\Type\Reference;

/**
 * Class CategoryReference
 * @package Sphere\Core\Model\Type
 * @method static TaxCategoryReference of(string $id)
 */
class TaxCategoryReference extends Reference
{
    const TYPE_TAX_CATEGORY = 'tax-category';

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        parent::__construct(static::TYPE_TAX_CATEGORY, $id);
    }
}
