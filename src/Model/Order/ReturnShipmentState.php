<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

/**
 * Class ReturnShipmentState
 * @package Sphere\Core\Model\Order
 */
class ReturnShipmentState
{
    const ADVISED = 'Advised';
    const RETURNED = 'Returned';
    const BACK_IN_STOCK = 'BackInStock';
    const UNUSABLE = 'Unusable';
}
