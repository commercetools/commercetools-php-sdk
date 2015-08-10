<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#set-tax-category
 * @method string getAction()
 * @method ProductSetTaxCategoryAction setAction(string $action = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ProductSetTaxCategoryAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method bool getStaged()
 * @method ProductSetTaxCategoryAction setStaged(bool $staged = null)
 */
class ProductSetTaxCategoryAction extends AbstractAction
{
    public function getPropertyDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Commercetools\Core\Model\TaxCategory\TaxCategoryReference'],
            'staged' => [static::TYPE => 'bool']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTaxCategory');
    }
}
