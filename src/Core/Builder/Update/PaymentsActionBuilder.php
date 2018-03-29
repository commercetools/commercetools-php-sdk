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
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-customer
     * @param array $data
     * @return PaymentSetCustomerAction
     */
    public function setCustomer(array $data = [])
    {
        return new PaymentSetCustomerAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#add-interfaceinteraction
     * @param array $data
     * @return PaymentAddInterfaceInteractionAction
     */
    public function addInterfaceInteraction(array $data = [])
    {
        return new PaymentAddInterfaceInteractionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-custom-type
     * @param array $data
     * @return PaymentSetCustomTypeAction
     */
    public function setCustomType(array $data = [])
    {
        return new PaymentSetCustomTypeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-externalid
     * @param array $data
     * @return PaymentSetExternalIdAction
     */
    public function setExternalId(array $data = [])
    {
        return new PaymentSetExternalIdAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-customfield
     * @param array $data
     * @return PaymentSetCustomFieldAction
     */
    public function setCustomField(array $data = [])
    {
        return new PaymentSetCustomFieldAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#transition-state
     * @param array $data
     * @return PaymentTransitionStateAction
     */
    public function transitionState(array $data = [])
    {
        return new PaymentTransitionStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactionstate
     * @param array $data
     * @return PaymentChangeTransactionStateAction
     */
    public function changeTransactionState(array $data = [])
    {
        return new PaymentChangeTransactionStateAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-authorization
     * @param array $data
     * @return PaymentSetAuthorizationAction
     */
    public function setAuthorization(array $data = [])
    {
        return new PaymentSetAuthorizationAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfomethod
     * @param array $data
     * @return PaymentSetMethodInfoMethodAction
     */
    public function setMethodInfoMethod(array $data = [])
    {
        return new PaymentSetMethodInfoMethodAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactioninteractionid
     * @param array $data
     * @return PaymentChangeTransactionInteractionIdAction
     */
    public function changeTransactionInteractionId(array $data = [])
    {
        return new PaymentChangeTransactionInteractionIdAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-statusinterfacetext
     * @param array $data
     * @return PaymentSetStatusInterfaceTextAction
     */
    public function setStatusInterfaceText(array $data = [])
    {
        return new PaymentSetStatusInterfaceTextAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-statusinterfacecode
     * @param array $data
     * @return PaymentSetStatusInterfaceCodeAction
     */
    public function setStatusInterfaceCode(array $data = [])
    {
        return new PaymentSetStatusInterfaceCodeAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfointerface
     * @param array $data
     * @return PaymentSetMethodInfoInterfaceAction
     */
    public function setMethodInfoInterface(array $data = [])
    {
        return new PaymentSetMethodInfoInterfaceAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-amountrefunded
     * @param array $data
     * @return PaymentSetAmountRefundedAction
     */
    public function setAmountRefunded(array $data = [])
    {
        return new PaymentSetAmountRefundedAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfoname
     * @param array $data
     * @return PaymentSetMethodInfoNameAction
     */
    public function setMethodInfoName(array $data = [])
    {
        return new PaymentSetMethodInfoNameAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-amountplanned
     * @param array $data
     * @return PaymentChangeAmountPlannedAction
     */
    public function changeAmountPlanned(array $data = [])
    {
        return new PaymentChangeAmountPlannedAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#add-transaction
     * @param array $data
     * @return PaymentAddTransactionAction
     */
    public function addTransaction(array $data = [])
    {
        return new PaymentAddTransactionAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-key
     * @param array $data
     * @return PaymentSetKeyAction
     */
    public function setKey(array $data = [])
    {
        return new PaymentSetKeyAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-amountpaid
     * @param array $data
     * @return PaymentSetAmountPaidAction
     */
    public function setAmountPaid(array $data = [])
    {
        return new PaymentSetAmountPaidAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactiontimestamp
     * @param array $data
     * @return PaymentChangeTransactionTimestampAction
     */
    public function changeTransactionTimestamp(array $data = [])
    {
        return new PaymentChangeTransactionTimestampAction($data);
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-interfaceid
     * @param array $data
     * @return PaymentSetInterfaceIdAction
     */
    public function setInterfaceId(array $data = [])
    {
        return new PaymentSetInterfaceIdAction($data);
    }

    /**
     * @return PaymentsActionBuilder
     */
    public function of()
    {
        return new self();
    }
}
