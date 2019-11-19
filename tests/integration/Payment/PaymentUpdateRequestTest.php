<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Payment;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Payment\PaymentMethodInfo;
use Commercetools\Core\Model\Payment\Transaction;
use Commercetools\Core\Model\Payment\TransactionState;
use Commercetools\Core\Model\State\State;
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
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomerAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomFieldAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetCustomTypeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetExternalIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetInterfaceIdAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetKeyAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoInterfaceAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoMethodAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetMethodInfoNameAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceCodeAction;
use Commercetools\Core\Request\Payments\Command\PaymentSetStatusInterfaceTextAction;
use Commercetools\Core\Request\Payments\Command\PaymentTransitionStateAction;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateByKeyRequest;
use Commercetools\Core\Request\Payments\PaymentUpdateRequest;

class PaymentUpdateRequestTest extends ApiTestCase
{
    /**
     * @return PaymentDraft
     */
    protected function getDraft()
    {
        $externalId = 'test-' . $this->getTestRun() . '-payment';
        $draft = PaymentDraft::ofKeyExternalIdAmountPlannedAndPaymentMethodInfo(
            $externalId,
            $externalId,
            Money::ofCurrencyAndAmount('EUR', 100),
            PaymentMethodInfo::of()
                ->setPaymentInterface('Test')
                ->setMethod('CreditCard')
        );

        return $draft;
    }

    protected function createPayment(PaymentDraft $draft)
    {
        $request = PaymentCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $payment = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = PaymentDeleteRequest::ofIdAndVersion(
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($amount, $result->getAmountPlanned()->getCentAmount());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testUpdateByKey()
    {
        $key = $this->getTestRun() . '-key';
        $draft = $this->getDraft();
        $draft->setKey($this->getTestRun() . '-key');
        $payment = $this->createPayment($draft);

        $customer = $this->getCustomer();
        $request = PaymentUpdateByKeyRequest::ofKeyAndVersion($key, $payment->getVersion())
            ->addAction(
                PaymentSetCustomerAction::of()->setCustomer($customer->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($customer->getId(), $result->getCustomer()->getId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetAnonymousId()
    {
        $anonymousId = $this->getTestRun() . '-anon';
        $draft = $this->getDraft();
        $draft->setAnonymousId($anonymousId);
        $payment = $this->createPayment($draft);
        $this->assertSame($anonymousId, $payment->getAnonymousId());

        $anonymousId = $this->getTestRun() . '-new-anon';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetAnonymousIdAction::of()->setAnonymousId($anonymousId)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($anonymousId, $result->getAnonymousId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetKey()
    {
        $key = $this->getTestRun() . '-key';
        $draft = $this->getDraft();
        $draft->setKey($key);
        $payment = $this->createPayment($draft);
        $this->assertSame($key, $payment->getKey());

        $key = $this->getTestRun() . '-new-key';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetKeyAction::of()->setKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($key, $result->getKey());
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($externalId, $result->getExternalId());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetInterfaceId()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $interfaceId = $this->getTestRun() . '-interfaceId';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetInterfaceIdAction::of()->setInterfaceId($interfaceId)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($interfaceId, $result->getInterfaceId());
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($amount->getCentAmount(), $result->getAmountAuthorized()->getCentAmount());
        $authTime->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($authTime->format('c'), $result->getAuthorizedUntil()->format('c'));
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($amount->getCentAmount(), $result->getAmountRefunded()->getCentAmount());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetMethodInfoInterface()
    {
        $externalId = 'test-' . $this->getTestRun() . '-payment';
        $draft = PaymentDraft::ofKeyExternalIdAndAmountPlanned(
            $externalId,
            $externalId,
            Money::ofCurrencyAndAmount('EUR', 100)
        );
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($interface, $result->getPaymentMethodInfo()->getPaymentInterface());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetMethodInfoMethod()
    {
        $externalId = 'test-' . $this->getTestRun() . '-payment';
        $draft = PaymentDraft::ofKeyExternalIdAndAmountPlanned(
            $externalId,
            $externalId,
            Money::ofCurrencyAndAmount('EUR', 100)
        );
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($method, $result->getPaymentMethodInfo()->getMethod());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }

    public function testSetMethodInfoName()
    {
        $externalId = 'test-' . $this->getTestRun() . '-payment';
        $draft = PaymentDraft::ofKeyExternalIdAndAmountPlanned(
            $externalId,
            $externalId,
            Money::ofCurrencyAndAmount('EUR', 100)
        );
        $payment = $this->createPayment($draft);

        $name = $this->getTestRun() . '-name';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentSetMethodInfoNameAction::of()
                    ->setName(LocalizedString::ofLangAndText('en', $name))
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        list($state1, $state2) = $this->createStates('PaymentState');
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentTransitionStateAction::ofState($state1->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());
        $payment = $result;

        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentTransitionStateAction::ofState($state2->getReference())
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $timestamp->setTimezone(new \DateTimeZone('UTC'));
        $this->assertSame($timestamp->format('c'), $result->getTransactions()->current()->getTimestamp()->getDateTime()->format('c'));
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
        $payment = $result;
        $transaction = $payment->getTransactions()->current();

        $interactionId = $this->getTestRun() . '-new';
        $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
            ->addAction(
                PaymentChangeTransactionInteractionIdAction::ofTransactionIdAndInteractionId(
                    $transaction->getId(),
                    $interactionId
                )
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
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
        $this->deleteRequest->setVersion($result->getVersion());
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
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(Payment::class, $result);
        $this->assertSame($value, $result->getCustom()->getFields()->getTestField());
        $this->assertNotSame($payment->getVersion(), $result->getVersion());
    }
}
