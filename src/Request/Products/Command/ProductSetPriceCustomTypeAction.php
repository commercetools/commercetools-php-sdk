<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\Products\Command
 *
 * @method string getAction()
 * @method ProductSetPriceCustomTypeAction setAction(string $action = null)
 * @method string getTypeId()
 * @method ProductSetPriceCustomTypeAction setTypeId(string $typeId = null)
 * @method string getTypeKey()
 * @method ProductSetPriceCustomTypeAction setTypeKey(string $typeKey = null)
 * @method int getPriceId()
 * @method ProductSetPriceCustomTypeAction setPriceId(int $priceId = null)
 * @method bool getStaged()
 * @method ProductSetPriceCustomTypeAction setStaged(bool $staged = null)
 * @method FieldContainer getFields()
 * @method ProductSetPriceCustomTypeAction setFields(FieldContainer $fields = null)
 */
class ProductSetPriceCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'typeId' => [static::TYPE => 'string'],
            'typeKey' => [static::TYPE => 'string'],
            'priceId' => [static::TYPE => 'int'],
            'staged' => [static::TYPE => 'bool'],
            'fields' => [static::TYPE => '\Commercetools\Core\Model\CustomField\FieldContainer'],
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
