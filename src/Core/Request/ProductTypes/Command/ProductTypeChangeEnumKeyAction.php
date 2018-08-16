<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * phpcs:disable
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-the-key-of-an-enumvalue
 * phpcs:enable
 * @method string getAction()
 * @method ProductTypeChangeEnumKeyAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeEnumKeyAction setAttributeName(string $attributeName = null)
 * @method string getKey()
 * @method ProductTypeChangeEnumKeyAction setKey(string $key = null)
 * @method string getNewKey()
 * @method ProductTypeChangeEnumKeyAction setNewKey(string $newKey = null)
 */
class ProductTypeChangeEnumKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'newKey' => [static::TYPE => 'string']

        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeEnumKey');
    }

    /**
     * @param string $attributeName
     * @param string $enumKey
     * @param string $newEnumKey
     * @param Context|callable $context
     * @return ProductTypeChangeEnumKeyAction
     */
    public static function ofAttributeNameAndEnumKey($attributeName, $enumKey, $newEnumKey, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setkey($enumKey)->setNewKey($newEnumKey);
    }
}
