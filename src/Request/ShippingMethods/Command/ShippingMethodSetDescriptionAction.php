<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * 
 * @method string getAction()
 * @method ShippingMethodSetDescriptionAction setAction(string $action = null)
 * @method string getDescription()
 * @method ShippingMethodSetDescriptionAction setDescription(string $description = null)
 */
class ShippingMethodSetDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDescription');
    }
}
