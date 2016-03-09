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
 * @link http://dev.commercetools.com/http-api-projects-productTypes.html#set-attribute-definition-inputtip
 * @method string getAction()
 * @method ProductTypeSetInputTipAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeSetInputTipAction setAttributeName(string $attributeName = null)
 * @method LocalizedString getInputTip()
 * @method ProductTypeSetInputTipAction setInputTip(LocalizedString $inputTip = null)
 */
class ProductTypeSetInputTipAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'inputTip' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setInputTip');
    }

    /**
     * @param string $attributeName
     * @param Context|callable $context
     * @return static
     */
    public static function ofAttributeName($attributeName, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName);
    }
}
