<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Reference;

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
