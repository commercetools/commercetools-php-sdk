<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Payment
 *
 * @method TransactionCollection add(Transaction $element)
 * @method Transaction current()
 * @method Transaction getAt($offset)
 */
class TransactionCollection extends Collection
{
    const INTERACTION_ID = 'interactionId';
    protected $type = '\Commercetools\Core\Model\Payment\Transaction';


    protected function indexRow($offset, $row)
    {
        if ($row instanceof Transaction) {
            $id = $row->getInteractionId();
        } else {
            $id = isset($row[static::INTERACTION_ID]) ? $row[static::INTERACTION_ID] : null;
        }
        $this->addToIndex(static::INTERACTION_ID, $offset, $id);
    }

    /**
     * @param $id
     * @return Payment
     */
    public function getByInteractionId($id)
    {
        return $this->getBy(static::INTERACTION_ID, $id);
    }
}
