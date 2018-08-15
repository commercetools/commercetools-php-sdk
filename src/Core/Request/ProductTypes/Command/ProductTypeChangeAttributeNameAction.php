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
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-name
 * phpcs:enable
 * @method string getAction()
 * @method ProductTypeChangeAttributeNameAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeAttributeNameAction setAttributeName(string $attributeName = null)
 * @method string getNewAttributeName()
 * @method ProductTypeChangeAttributeNameAction setNewAttributeName(string $newAttributeName = null)
 */
class ProductTypeChangeAttributeNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'newAttributeName' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeAttributeName');
    }

    /**
     * @param string $attributeName
     * @param string $newAttributeName
     * @param Context|callable $context
     * @return ProductTypeChangeAttributeNameAction
     */
    public static function ofAttributeName($attributeName, $newAttributeName, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setNewAttributeName($newAttributeName);
    }
}
