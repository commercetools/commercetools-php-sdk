<?php

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-localized-description
 * @method string getAction()
 * @method ShippingMethodSetLocalizedDescriptionAction setAction(string $action = null)
 * @method LocalizedString getLocalizedDescription()
 * phpcs:disable
 * @method ShippingMethodSetLocalizedDescriptionAction setLocalizedDescription(LocalizedString $localizedDescription = null)
 * phpcs:enable
 */
class ShippingMethodSetLocalizedDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'localizedDescription' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLocalizedDescription');
    }
}
