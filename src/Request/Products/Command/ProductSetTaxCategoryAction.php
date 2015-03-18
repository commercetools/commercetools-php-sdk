<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\TaxCategory\TaxCategoryReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductSetTaxCategoryAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductSetTaxCategoryAction setAction(string $action = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ProductSetTaxCategoryAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method bool getStaged()
 * @method ProductSetTaxCategoryAction setStaged(bool $staged = null)
 */
class ProductSetTaxCategoryAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference'],
            'staged' => [static::TYPE => 'bool']
        ];
    }

    /**
     *
     */
    public function __construct()
    {
        $this->setAction('setTaxCategory');
    }
}
