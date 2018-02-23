<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-price-custom-type
 * @method string getAction()
 * @method ProductSetPriceCustomTypeAction setAction(string $action = null)
 * @method string getPriceId()
 * @method ProductSetPriceCustomTypeAction setPriceId(string $priceId = null)
 * @method bool getStaged()
 * @method ProductSetPriceCustomTypeAction setStaged(bool $staged = null)
 * @method FieldContainer getFields()
 * @method ProductSetPriceCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method ProductSetPriceCustomTypeAction setType(TypeReference $type = null)
 */
class ProductSetPriceCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'priceId' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
            'fields' => [static::TYPE => FieldContainer::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setProductPriceCustomType');
    }
}
