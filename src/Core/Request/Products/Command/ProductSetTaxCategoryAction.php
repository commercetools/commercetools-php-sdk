<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\TaxCategory\TaxCategoryReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-taxcategory
 * @method string getAction()
 * @method ProductSetTaxCategoryAction setAction(string $action = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ProductSetTaxCategoryAction setTaxCategory(TaxCategoryReference $taxCategory = null)
 */
class ProductSetTaxCategoryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => TaxCategoryReference::class],
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

    /**
     * @deprecated not supported by Composable Commerce - will be removed in 3.0
     * @return null
     */
    public function getStaged()
    {
        return null;
    }

    /**
     * @deprecated not supported by Composable Commerce - will be removed in 3.0
     * @return ProductSetTaxCategoryAction
     */
    public function setStaged()
    {
        return $this;
    }
}
