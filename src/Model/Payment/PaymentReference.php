<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

/**
 * @package Commercetools\Core\Model\Payment
 *
 * @method string getTypeId()
 * @method PaymentReference setTypeId(string $typeId = null)
 * @method string getId()
 * @method PaymentReference setId(string $id = null)
 * @method Payment getObj()
 * @method PaymentReference setObj(Payment $obj = null)
 * @method string getKey()
 * @method PaymentReference setKey(string $key = null)
 */
class PaymentReference extends Reference
{
    const TYPE_PAYMENT = 'payment';

    public function fieldDefinitions()
    {
        $fields = parent::fieldDefinitions();
        $fields[static::OBJ] = [static::TYPE => '\Commercetools\Core\Model\Payment\Payment'];

        return $fields;
    }

    /**
     * @param $id
     * @param Context|callable $context
     * @return PaymentReference
     */
    public static function ofId($id, $context = null)
    {
        return static::ofTypeAndId(static::TYPE_PAYMENT, $id, $context);
    }
}
