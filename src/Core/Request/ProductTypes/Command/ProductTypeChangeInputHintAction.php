<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-inputhint
 * @method string getAction()
 * @method ProductTypeChangeInputHintAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeInputHintAction setAttributeName(string $attributeName = null)
 * @method string getNewValue()
 * @method ProductTypeChangeInputHintAction setNewValue(string $newValue = null)
 */
class ProductTypeChangeInputHintAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'newValue' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeInputHint');
    }

    /**
     * @param string $attributeName
     * @param string $inputHint
     * @param Context|callable $context
     * @return ProductTypeChangeInputHintAction
     */
    public static function ofAttributeNameAndInputHint($attributeName, $inputHint, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setNewValue($inputHint);
    }
}
