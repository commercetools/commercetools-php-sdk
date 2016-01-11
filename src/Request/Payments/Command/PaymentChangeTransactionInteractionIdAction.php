<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Payments\Command
 *
 * @method string getAction()
 * @method PaymentChangeTransactionInteractionIdAction setAction(string $action = null)
 * @method string getTransactionId()
 * @method PaymentChangeTransactionInteractionIdAction setTransactionId(string $transactionId = null)
 * @method string getInteractionId()
 * @method PaymentChangeTransactionInteractionIdAction setInteractionId(string $interactionId = null)
 */
class PaymentChangeTransactionInteractionIdAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'transactionId' => [static::TYPE => 'string'],
            'interactionId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTransactionInteractionId');
    }

    /**
     * @param string $transactionId
     * @param string $interactionId
     * @param Context|callable $context
     * @return PaymentAddTransactionAction
     */
    public static function ofTransactionIdAndState($transactionId, $interactionId, $context = null)
    {
        return static::of($context)->setTransactionId($transactionId)->setInteractionId($interactionId);
    }
}
