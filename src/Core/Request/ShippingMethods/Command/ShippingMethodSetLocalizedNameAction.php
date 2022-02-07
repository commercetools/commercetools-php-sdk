<?php

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://docs.commercetools.com/api/projects/shippingMethods#set-localized-name
 * @method string getAction()
 * @method ShippingMethodSetLocalizedNameAction setAction(string $action = null)
 * @method LocalizedString getLocalizedName()
 * @method ShippingMethodSetLocalizedNameAction setLocalizedName(LocalizedString $localizedName = null)
 */
class ShippingMethodSetLocalizedNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'localizedName' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLocalizedName');
    }
}
