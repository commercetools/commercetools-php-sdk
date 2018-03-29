<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Orders\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Order\DeliveryItemCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Orders\Command
 *
 * @link https://docs.commercetools.com/http-api-projects-orders.html#remove-parcel-from-delivery
 * @method string getAction()
 * @method OrderRemoveParcelFromDeliveryAction setAction(string $action = null)
 * @method string getParcelId()
 * @method OrderRemoveParcelFromDeliveryAction setParcelId(string $parcelId = null)
 */
class OrderRemoveParcelFromDeliveryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'parcelId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $parcelId
     * @param Context|callable $context
     * @return OrderRemoveParcelFromDeliveryAction
     */
    public static function ofParcel($parcelId, $context = null)
    {
        return static::of($context)->setParcelId($parcelId);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeParcelFromDelivery');
    }
}
