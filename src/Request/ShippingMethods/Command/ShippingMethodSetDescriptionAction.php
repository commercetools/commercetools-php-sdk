<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ShippingMethods\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ShippingMethods\Command
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
