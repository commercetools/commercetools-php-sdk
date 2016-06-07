<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#set-price-custom-field
 * @method string getAction()
 * @method ProductSetPriceCustomFieldAction setAction(string $action = null)
 * @method string getPriceId()
 * @method ProductSetPriceCustomFieldAction setPriceId(string $priceId = null)
 * @method bool getStaged()
 * @method ProductSetPriceCustomFieldAction setStaged(bool $staged = null)
 * @method string getName()
 * @method ProductSetPriceCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method ProductSetPriceCustomFieldAction setValue($value = null)
 */
class ProductSetPriceCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'priceId' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setProductPriceCustomField');
    }
}
