<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Project\ShippingRateInputType;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://dev.commercetools.com/http-api-projects-project.html#set-shippingrateinputtype
 * @method string getAction()
 * @method ProjectSetShippingRateInputTypeAction setAction(string $action = null)
 * @method ShippingRateInputType getShippingRateInputType()
 * @codingStandardsIgnoreStart
 * @method ProjectSetShippingRateInputTypeAction setShippingRateInputType(ShippingRateInputType $shippingRateInputType = null)
 * @codingStandardsIgnoreEnd
 */
class ProjectSetShippingRateInputTypeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shippingRateInputType' => [static::TYPE => ShippingRateInputType::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setShippingRateInputType');
    }
}
