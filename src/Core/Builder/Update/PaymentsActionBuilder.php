<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Request\Payments\Command\PaymentAddInterfaceInteractionAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddTransactionAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeAmountPlannedAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionInteractionIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionStateAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionTimestampAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountPaidAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountRefundedAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAuthorizationAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomFieldAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomTypeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomerAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetExternalIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetInterfaceIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetKeyAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoInterfaceAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoMethodAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoNameAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceCodeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceTextAction;
use Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction;

class PaymentsActionBuilder
{
    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#add-interfaceinteraction
     * @param array $data
     * @return PaymentAddInterfaceInteractionAction
     */
    public function addInterfaceInteraction(array $data = [])
    {
        return PaymentAddInterfaceInteractionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#add-transaction
     * @param array $data
     * @return PaymentAddTransactionAction
     */
    public function addTransaction(array $data = [])
    {
        return PaymentAddTransactionAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-amountplanned
     * @param array $data
     * @return PaymentChangeAmountPlannedAction
     */
    public function changeAmountPlanned(array $data = [])
    {
        return PaymentChangeAmountPlannedAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactioninteractionid
     * @param array $data
     * @return PaymentChangeTransactionInteractionIdAction
     */
    public function changeTransactionInteractionId(array $data = [])
    {
        return PaymentChangeTransactionInteractionIdAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactionstate
     * @param array $data
     * @return PaymentChangeTransactionStateAction
     */
    public function changeTransactionState(array $data = [])
    {
        return PaymentChangeTransactionStateAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactiontimestamp
     * @param array $data
     * @return PaymentChangeTransactionTimestampAction
     */
    public function changeTransactionTimestamp(array $data = [])
    {
        return PaymentChangeTransactionTimestampAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-amountpaid
     * @param array $data
     * @return PaymentSetAmountPaidAction
     */
    public function setAmountPaid(array $data = [])
    {
        return PaymentSetAmountPaidAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-amountrefunded
     * @param array $data
     * @return PaymentSetAmountRefundedAction
     */
    public function setAmountRefunded(array $data = [])
    {
        return PaymentSetAmountRefundedAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-authorization
     * @param array $data
     * @return PaymentSetAuthorizationAction
     */
    public function setAuthorization(array $data = [])
    {
        return PaymentSetAuthorizationAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-customfield
     * @param array $data
     * @return PaymentSetCustomFieldAction
     */
    public function setCustomField(array $data = [])
    {
        return PaymentSetCustomFieldAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-custom-type
     * @param array $data
     * @return PaymentSetCustomTypeAction
     */
    public function setCustomType(array $data = [])
    {
        return PaymentSetCustomTypeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-customer
     * @param array $data
     * @return PaymentSetCustomerAction
     */
    public function setCustomer(array $data = [])
    {
        return PaymentSetCustomerAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-externalid
     * @param array $data
     * @return PaymentSetExternalIdAction
     */
    public function setExternalId(array $data = [])
    {
        return PaymentSetExternalIdAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-interfaceid
     * @param array $data
     * @return PaymentSetInterfaceIdAction
     */
    public function setInterfaceId(array $data = [])
    {
        return PaymentSetInterfaceIdAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-key
     * @param array $data
     * @return PaymentSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return PaymentSetKeyAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfointerface
     * @param array $data
     * @return PaymentSetMethodInfoInterfaceAction
     */
    public function setMethodInfoInterface(array $data = [])
    {
        return PaymentSetMethodInfoInterfaceAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfomethod
     * @param array $data
     * @return PaymentSetMethodInfoMethodAction
     */
    public function setMethodInfoMethod(array $data = [])
    {
        return PaymentSetMethodInfoMethodAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfoname
     * @param array $data
     * @return PaymentSetMethodInfoNameAction
     */
    public function setMethodInfoName(array $data = [])
    {
        return PaymentSetMethodInfoNameAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-statusinterfacecode
     * @param array $data
     * @return PaymentSetStatusInterfaceCodeAction
     */
    public function setStatusInterfaceCode(array $data = [])
    {
        return PaymentSetStatusInterfaceCodeAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-statusinterfacetext
     * @param array $data
     * @return PaymentSetStatusInterfaceTextAction
     */
    public function setStatusInterfaceText(array $data = [])
    {
        return PaymentSetStatusInterfaceTextAction::fromArray($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#transition-state
     * @param array $data
     * @return PaymentTransitionStateAction
     */
    public function transitionState(array $data = [])
    {
        return PaymentTransitionStateAction::fromArray($data);
    }

    /**
     * @return PaymentsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
