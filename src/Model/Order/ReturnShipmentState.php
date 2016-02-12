<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

/**
 * @package Commercetools\Core\Model\Order
 * @link http://dev.commercetools.com/http-api-projects-orders.html#return-shipment-state
 */
class ReturnShipmentState
{
    const ADVISED = 'Advised';
    const RETURNED = 'Returned';
    const BACK_IN_STOCK = 'BackInStock';
    const UNUSABLE = 'Unusable';
}
