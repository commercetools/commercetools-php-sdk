<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Payment;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Customer\Customer;
use Commercetools\Core\Model\Customer\CustomerDraft;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Payment\PaymentMethodInfo;
use Commercetools\Core\Model\Payment\Transaction;
use Commercetools\Core\Model\Payment\TransactionState;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\State\StateReferenceCollection;
use Commercetools\Core\Model\Type\FieldDefinition;
use Commercetools\Core\Model\Type\FieldDefinitionCollection;
use Commercetools\Core\Model\Type\StringType;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Customers\CustomerCreateRequest;
use Commercetools\Core\Request\Customers\CustomerDeleteRequest;
use Commercetools\Core\Request\Payments\Command\PaymentAddInterfaceInteractionAction;
use Commercetools\Core\Request\Payments\Command\PaymentAddTransactionAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeAmountPlannedAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionInteractionIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionStateAction;
use Commercetools\Core\Request\Payments\Command\PaymentChangeTransactionTimestampAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountPaidAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAmountRefundedAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetAuthorizationAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomerAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomFieldAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomTypeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetExternalIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoInterfaceAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoMethodAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoNameAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceCodeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceTextAction;
use Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateRequest;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;

class PaymentQueryRequestTest extends ApiTestCase
{
    /**
     * @var PaymentDeleteRequest
     */
    private $paymentDeleteRequest;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var State
     */
    private $state1;

    /**
     * @var State
     */
    private $state2;

    /**
     * @var StateDeleteRequest[]
     */
    private $stateCleanupRequests;

    /**
     * @return PaymentDraft
     */
    protected function getDraft()
    {
        $draft = PaymentDraft::of()
            ->setExternalId('test-' . $this->getTestRun() . '-payment')
            ->setAmountPlanned(Money::ofCurrencyAndAmount('EUR', 100))
            ->setPaymentMethodInfo(
                PaymentMethodInfo::of()
                    ->setPaymentInterface('Test')
                    ->setMethod('CreditCard')
            )
        ;
        return $draft;
    }

    protected function createPayment(PaymentDraft $draft)
    {
        $request = PaymentCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $payment = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->paymentDeleteRequest = PaymentDeleteRequest::ofIdAndVersion(
            $payment->getId(),
            $payment->getVersion()
        );

        return $payment;
    }

    public function testPaymentPlanned()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $amount = 200;
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentChangeAmountPlannedAction::of()->setAmount(Money::ofCurrencyAndAmount('EUR', $amount))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($amount, $result->getAmountPlanned()->getCentAmount());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetCustomer()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $customer = $this->getCustomer();
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetCustomerAction::of()->setCustomer($customer->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetExternalId()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $externalId = $this->getTestRun() . '-externalId';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetExternalIdAction::of()->setExternalId($externalId)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($externalId, $result->getExternalId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetAuthorization()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $authTime = new \DateTime();
        $amount = Money::ofCurrencyAndAmount('EUR', 100);
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetAuthorizationAction::of()
                    ->setAmount($amount)
                    ->setUntil($authTime)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($amount->getCentAmount(), $result->getAmountAuthorized()->getCentAmount());
        $this->assertEquals($authTime, $result->getAuthorizedUntil()->getDateTime());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetAmountPaid()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $amount = Money::ofCurrencyAndAmount('EUR', 100);
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetAmountPaidAction::of()
                    ->setAmount($amount)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($amount->getCentAmount(), $result->getAmountPaid()->getCentAmount());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetAmountRefunded()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $amount = Money::ofCurrencyAndAmount('EUR', 100);
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetAmountRefundedAction::of()
                    ->setAmount($amount)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($amount->getCentAmount(), $result->getAmountRefunded()->getCentAmount());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetMethodInfoInterface()
    {
        $draft = PaymentDraft::of()
            ->setExternalId('test-' . $this->getTestRun() . '-payment')
            ->setAmountPlanned(Money::ofCurrencyAndAmount('EUR', 100))
        ;
        $payment = $this->createPayment($draft);

        $interface = $this->getTestRun() . '-interface';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetMethodInfoInterfaceAction::of()
                    ->setInterface($interface)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($interface, $result->getPaymentMethodInfo()->getPaymentInterface());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetMethodInfoMethod()
    {
        $draft = PaymentDraft::of()
            ->setExternalId('test-' . $this->getTestRun() . '-payment')
            ->setAmountPlanned(Money::ofCurrencyAndAmount('EUR', 100))
        ;
        $payment = $this->createPayment($draft);

        $method = $this->getTestRun() . '-method';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetMethodInfoMethodAction::of()
                    ->setMethod($method)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($method, $result->getPaymentMethodInfo()->getMethod());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetMethodInfoName()
    {
        $draft = PaymentDraft::of()
            ->setExternalId('test-' . $this->getTestRun() . '-payment')
            ->setAmountPlanned(Money::ofCurrencyAndAmount('EUR', 100))
        ;
        $payment = $this->createPayment($draft);

        $name = $this->getTestRun() . '-name';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetMethodInfoNameAction::of()
                    ->setName(LocalizedString::ofLangAndText('en',$name))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($name, $result->getPaymentMethodInfo()->getName()->en);
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetStatusInterfaceCode()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $code = $this->getTestRun() . '-code';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetStatusInterfaceCodeAction::of()
                    ->setInterfaceCode($code)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($code, $result->getPaymentStatus()->getInterfaceCode());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetStatusInterfaceText()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $text = $this->getTestRun() . '-text';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetStatusInterfaceTextAction::of()
                    ->setInterfaceText($text)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($text, $result->getPaymentStatus()->getInterfaceText());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testTransitionState()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        /**
         * @var State $state1
         * @var State $state2
         */
        list($state1, $state2) = $this->createStates();
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentTransitionStateAction::ofState($state1->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());
        $payment = $result;

        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentTransitionStateAction::ofState($state2->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($state2->getId(), $result->getPaymentStatus()->getState()->getId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testTransactions()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $transaction = Transaction::of()
            ->setType('Authorization')
            ->setAmount(Money::ofCurrencyAndAmount('EUR', 100))
            ->setInteractionId($this->getTestRun());
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentAddTransactionAction::of()
                    ->setTransaction($transaction)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($transaction->getInteractionId(), $result->getTransactions()->current()->getInteractionId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
        $payment = $result;
        $transaction = $payment->getTransactions()->current();

        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentChangeTransactionStateAction::of()
                    ->setTransactionId($transaction->getId())
                    ->setState(TransactionState::SUCCESS)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame(TransactionState::SUCCESS, $result->getTransactions()->current()->getState());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
        $payment = $result;
        $transaction = $payment->getTransactions()->current();

        $timestamp = new \DateTime();
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentChangeTransactionTimestampAction::of()
                    ->setTransactionId($transaction->getId())
                    ->setTimestamp($timestamp)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertEquals($timestamp, $result->getTransactions()->current()->getTimestamp()->getDateTime());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
        $payment = $result;
        $transaction = $payment->getTransactions()->current();

        $interactionId = $this->getTestRun() . '-new';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentChangeTransactionInteractionIdAction::of()
                    ->setTransactionId($transaction->getId())
                    ->setInteractionId($interactionId)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($interactionId, $result->getTransactions()->current()->getInteractionId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testAddInterfaceInteraction()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $type = $this->getType($this->getTestRun().'-key', 'payment-interface-interaction');
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentAddInterfaceInteractionAction::of()
                    ->setType($type->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($type->getId(), $result->getInterfaceInteractions()->current()->getType()->getId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testCustomType()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $type = $this->getType($this->getTestRun().'-key', 'payment');
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetCustomTypeAction::of()
                    ->setType($type->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testCustomField()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $type = $this->getType($this->getTestRun().'-key', 'payment');
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetCustomTypeAction::of()
                    ->setType($type->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());
        $payment = $result;

        $value = $this->getTestRun() . '-value';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetCustomFieldAction::ofName('testField')
                    ->setValue($value)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->paymentDeleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result);
        $this->assertSame($value, $result->getCustom()->getFields()->getTestField());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteType();
        $this->deleteCustomer();
        $this->deleteStates();
    }

    /**
     * @return CustomerDraft
     */
    protected function getCustomerDraft()
    {
        $draft = CustomerDraft::ofEmailNameAndPassword(
            'test-' . $this->getTestRun() . '-email',
            'test-' . $this->getTestRun() . '-firstName',
            'test-' . $this->getTestRun() . '-lastName',
            'test-' . $this->getTestRun() . '-password'
        );

        return $draft;
    }

    protected function getCustomer()
    {
        if (is_null($this->customer)) {
            $draft = $this->getCustomerDraft();
            $request = CustomerCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $result = $request->mapResponse($response);
            $this->customer = $result->getCustomer();
        }

        return $this->customer;
    }

    protected function deleteCustomer()
    {
        if (!is_null($this->customer)) {
            $request = CustomerDeleteRequest::ofIdAndVersion(
                $this->customer->getId(),
                $this->customer->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->customer = $request->mapResponse($response);
        }

        $this->customer = null;
    }

    private function getType($key, $type)
    {
        if (is_null($this->type)) {
            $name = $this->getTestRun() . '-name';
            $typeDraft = TypeDraft::ofKeyNameDescriptionAndResourceTypes(
                $key,
                LocalizedString::ofLangAndText('en', $name),
                LocalizedString::ofLangAndText('en', $name),
                [$type]
            );
            $typeDraft->setFieldDefinitions(
                FieldDefinitionCollection::of()
                    ->add(
                        FieldDefinition::of()
                            ->setName('testField')
                            ->setLabel(LocalizedString::ofLangAndText('en', 'testField'))
                            ->setRequired(false)
                            ->setType(StringType::of())
                    )
            );
            $request = TypeCreateRequest::ofDraft($typeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }

        return $this->type;
    }

    private function deleteType()
    {
        if (!is_null($this->type)) {
            $request = TypeDeleteRequest::ofIdAndVersion(
                $this->type->getId(),
                $this->type->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }
        $this->type = null;
    }

    /**
     * @return State[]
     */
    private function createStates()
    {
        if (is_null($this->state1) && is_null($this->state2)) {
            $draft = StateDraft::ofKeyAndType(
                'test-' . $this->getTestRun() . '-key1',
                'PaymentState'
            )->setInitial(true);
            $request = StateCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->state1 = $state = $request->mapResponse($response);

            $this->stateCleanupRequests[] = StateDeleteRequest::ofIdAndVersion(
                $state->getId(),
                $state->getVersion()
            );

            $draft = StateDraft::ofKeyAndType(
                'test-' . $this->getTestRun() . '-key2',
                'PaymentState'
            )->setTransitions(StateReferenceCollection::of()->add($this->state1->getReference()));
            $request = StateCreateRequest::ofDraft($draft);
            $response = $request->executeWithClient($this->getClient());
            $this->state2 = $state = $request->mapResponse($response);

            array_unshift($this->stateCleanupRequests, StateDeleteRequest::ofIdAndVersion(
                $state->getId(),
                $state->getVersion()
            ));
        }

        return [$this->state1, $this->state2];
    }

    private function deleteStates()
    {
        if (!empty($this->stateCleanupRequests)) {
            foreach ($this->stateCleanupRequests as $request) {
                $request->executeWithClient($this->getClient());
            }
        }
        $this->stateCleanupRequests = [];
        $this->state1 = null;
        $this->state2 = null;
    }
}
