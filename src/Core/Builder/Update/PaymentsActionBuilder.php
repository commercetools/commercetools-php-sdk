<?php

namespace Commercetools\Core\Builder\Update;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddInterfaceInteractionAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddTransactionAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeAmountPlannedAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionInteractionIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionStateAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionTimestampAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountPaidAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountRefundedAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAnonymousIdAction;
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
use Commercetools\Core\Request\Payments\Command\PaymentSetTransactionCustomFieldAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetTransactionCustomTypeAction;
use Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction;

class PaymentsActionBuilder
{
    private $actions = [];

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#add-interfaceinteraction
     * @param PaymentAddInterfaceInteractionAction|callable $action
     * @return $this
     */
    public function addInterfaceInteraction($action = null)
    {
        $this->addAction($this->resolveAction(PaymentAddInterfaceInteractionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#add-transaction
     * @param PaymentAddTransactionAction|callable $action
     * @return $this
     */
    public function addTransaction($action = null)
    {
        $this->addAction($this->resolveAction(PaymentAddTransactionAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-amountplanned
     * @param PaymentChangeAmountPlannedAction|callable $action
     * @return $this
     */
    public function changeAmountPlanned($action = null)
    {
        $this->addAction($this->resolveAction(PaymentChangeAmountPlannedAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactioninteractionid
     * @param PaymentChangeTransactionInteractionIdAction|callable $action
     * @return $this
     */
    public function changeTransactionInteractionId($action = null)
    {
        $this->addAction($this->resolveAction(PaymentChangeTransactionInteractionIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactionstate
     * @param PaymentChangeTransactionStateAction|callable $action
     * @return $this
     */
    public function changeTransactionState($action = null)
    {
        $this->addAction($this->resolveAction(PaymentChangeTransactionStateAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#change-transactiontimestamp
     * @param PaymentChangeTransactionTimestampAction|callable $action
     * @return $this
     */
    public function changeTransactionTimestamp($action = null)
    {
        $this->addAction($this->resolveAction(PaymentChangeTransactionTimestampAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-amountpaid
     * @param PaymentSetAmountPaidAction|callable $action
     * @return $this
     */
    public function setAmountPaid($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetAmountPaidAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-amountrefunded
     * @param PaymentSetAmountRefundedAction|callable $action
     * @return $this
     */
    public function setAmountRefunded($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetAmountRefundedAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments#set-anonymousid
     * @param PaymentSetAnonymousIdAction|callable $action
     * @return $this
     */
    public function setAnonymousId($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetAnonymousIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-authorization
     * @param PaymentSetAuthorizationAction|callable $action
     * @return $this
     */
    public function setAuthorization($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetAuthorizationAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-customfield
     * @param PaymentSetCustomFieldAction|callable $action
     * @return $this
     */
    public function setCustomField($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetCustomFieldAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-custom-type
     * @param PaymentSetCustomTypeAction|callable $action
     * @return $this
     */
    public function setCustomType($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-customer
     * @param PaymentSetCustomerAction|callable $action
     * @return $this
     */
    public function setCustomer($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetCustomerAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-externalid
     * @param PaymentSetExternalIdAction|callable $action
     * @return $this
     */
    public function setExternalId($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetExternalIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-interfaceid
     * @param PaymentSetInterfaceIdAction|callable $action
     * @return $this
     */
    public function setInterfaceId($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetInterfaceIdAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-key
     * @param PaymentSetKeyAction|callable $action
     * @return $this
     */
    public function setKey($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetKeyAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfointerface
     * @param PaymentSetMethodInfoInterfaceAction|callable $action
     * @return $this
     */
    public function setMethodInfoInterface($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetMethodInfoInterfaceAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfomethod
     * @param PaymentSetMethodInfoMethodAction|callable $action
     * @return $this
     */
    public function setMethodInfoMethod($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetMethodInfoMethodAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-methodinfoname
     * @param PaymentSetMethodInfoNameAction|callable $action
     * @return $this
     */
    public function setMethodInfoName($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetMethodInfoNameAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-statusinterfacecode
     * @param PaymentSetStatusInterfaceCodeAction|callable $action
     * @return $this
     */
    public function setStatusInterfaceCode($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetStatusInterfaceCodeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#set-statusinterfacetext
     * @param PaymentSetStatusInterfaceTextAction|callable $action
     * @return $this
     */
    public function setStatusInterfaceText($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetStatusInterfaceTextAction::class, $action));
        return $this;
    }

    /**
     *
     * @param PaymentSetTransactionCustomFieldAction|callable $action
     * @return $this
     */
    public function setTransactionCustomField($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetTransactionCustomFieldAction::class, $action));
        return $this;
    }

    /**
     *
     * @param PaymentSetTransactionCustomTypeAction|callable $action
     * @return $this
     */
    public function setTransactionCustomType($action = null)
    {
        $this->addAction($this->resolveAction(PaymentSetTransactionCustomTypeAction::class, $action));
        return $this;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-payments.html#transition-state
     * @param PaymentTransitionStateAction|callable $action
     * @return $this
     */
    public function transitionState($action = null)
    {
        $this->addAction($this->resolveAction(PaymentTransitionStateAction::class, $action));
        return $this;
    }

    /**
     * @return PaymentsActionBuilder
     */
    public static function of()
    {
        return new self();
    }

    /**
     * @param $class
     * @param $action
     * @return AbstractAction
     * @throws InvalidArgumentException
     */
    private function resolveAction($class, $action = null)
    {
        if (is_null($action) || is_callable($action)) {
            $callback = $action;
            $emptyAction = $class::of();
            $action = $this->callback($emptyAction, $callback);
        }
        if ($action instanceof $class) {
            return $action;
        }
        throw new InvalidArgumentException(
            sprintf('Expected method to be called with or callable to return %s', $class)
        );
    }

    /**
     * @param $action
     * @param callable $callback
     * @return AbstractAction
     */
    private function callback($action, callable $callback = null)
    {
        if (!is_null($callback)) {
            $action = $callback($action);
        }
        return $action;
    }

    /**
     * @param AbstractAction $action
     * @return $this;
     */
    public function addAction(AbstractAction $action)
    {
        $this->actions[] = $action;
        return $this;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }


    /**
     * @param array $actions
     * @return $this
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
        return $this;
    }
}
