<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Payments\Command\PaymentSetCustomerAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddInterfaceInteractionAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomTypeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetExternalIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomFieldAction;
use Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionStateAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAuthorizationAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoMethodAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionInteractionIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceTextAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceCodeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoInterfaceAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountRefundedAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoNameAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeAmountPlannedAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddTransactionAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetKeyAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountPaidAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionTimestampAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetInterfaceIdAction;

class PaymentsActionBuilder
{
    /**
     * @return PaymentSetCustomerAction
     */
    public function setCustomer()
    {
        return PaymentSetCustomerAction::of();
    }

    /**
     * @return PaymentAddInterfaceInteractionAction
     */
    public function addInterfaceInteraction()
    {
        return PaymentAddInterfaceInteractionAction::of();
    }

    /**
     * @return PaymentSetCustomTypeAction
     */
    public function setCustomType()
    {
        return PaymentSetCustomTypeAction::of();
    }

    /**
     * @return PaymentSetExternalIdAction
     */
    public function setExternalId()
    {
        return PaymentSetExternalIdAction::of();
    }

    /**
     * @return PaymentSetCustomFieldAction
     */
    public function setCustomField()
    {
        return PaymentSetCustomFieldAction::of();
    }

    /**
     * @return PaymentTransitionStateAction
     */
    public function transitionState()
    {
        return PaymentTransitionStateAction::of();
    }

    /**
     * @return PaymentChangeTransactionStateAction
     */
    public function changeTransactionState()
    {
        return PaymentChangeTransactionStateAction::of();
    }

    /**
     * @return PaymentSetAuthorizationAction
     */
    public function setAuthorization()
    {
        return PaymentSetAuthorizationAction::of();
    }

    /**
     * @return PaymentSetMethodInfoMethodAction
     */
    public function setMethodInfoMethod()
    {
        return PaymentSetMethodInfoMethodAction::of();
    }

    /**
     * @return PaymentChangeTransactionInteractionIdAction
     */
    public function changeTransactionInteractionId()
    {
        return PaymentChangeTransactionInteractionIdAction::of();
    }

    /**
     * @return PaymentSetStatusInterfaceTextAction
     */
    public function setStatusInterfaceText()
    {
        return PaymentSetStatusInterfaceTextAction::of();
    }

    /**
     * @return PaymentSetStatusInterfaceCodeAction
     */
    public function setStatusInterfaceCode()
    {
        return PaymentSetStatusInterfaceCodeAction::of();
    }

    /**
     * @return PaymentSetMethodInfoInterfaceAction
     */
    public function setMethodInfoInterface()
    {
        return PaymentSetMethodInfoInterfaceAction::of();
    }

    /**
     * @return PaymentSetAmountRefundedAction
     */
    public function setAmountRefunded()
    {
        return PaymentSetAmountRefundedAction::of();
    }

    /**
     * @return PaymentSetMethodInfoNameAction
     */
    public function setMethodInfoName()
    {
        return PaymentSetMethodInfoNameAction::of();
    }

    /**
     * @return PaymentChangeAmountPlannedAction
     */
    public function changeAmountPlanned()
    {
        return PaymentChangeAmountPlannedAction::of();
    }

    /**
     * @return PaymentAddTransactionAction
     */
    public function addTransaction()
    {
        return PaymentAddTransactionAction::of();
    }

    /**
     * @return PaymentSetKeyAction
     */
    public function setKey()
    {
        return PaymentSetKeyAction::of();
    }

    /**
     * @return PaymentSetAmountPaidAction
     */
    public function setAmountPaid()
    {
        return PaymentSetAmountPaidAction::of();
    }

    /**
     * @return PaymentChangeTransactionTimestampAction
     */
    public function changeTransactionTimestamp()
    {
        return PaymentChangeTransactionTimestampAction::of();
    }

    /**
     * @return PaymentSetInterfaceIdAction
     */
    public function setInterfaceId()
    {
        return PaymentSetInterfaceIdAction::of();
    }
}
