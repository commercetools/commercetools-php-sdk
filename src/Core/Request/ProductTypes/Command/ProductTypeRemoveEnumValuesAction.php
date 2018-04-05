<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#remove-enumvalues-from-attributedefinition
 * @method string getAction()
 * @method ProductTypeRemoveEnumValuesAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeRemoveEnumValuesAction setAttributeName(string $attributeName = null)
 * @method array getKeys()
 * @method ProductTypeRemoveEnumValuesAction setKeys(array $keys = null)
 */
class ProductTypeRemoveEnumValuesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'keys' => [static::TYPE => 'array']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeEnumValues');
    }

    /**
     * @param string $attributeName
     * @param array $keys
     * @param Context|callable $context
     * @return ProductTypeAddPlainEnumValueAction
     */
    public static function ofAttributeNameAndKeys($attributeName, array $keys, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setKeys($keys);
    }
}
