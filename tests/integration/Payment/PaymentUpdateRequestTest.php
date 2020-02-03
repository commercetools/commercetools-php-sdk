<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\IntegrationTests\Payment;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\IntegrationTests\State\StateFixture;
use Commercetools\Core\IntegrationTests\Type\TypeFixture;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Payment\PaymentMethodInfo;
use Commercetools\Core\Model\Payment\Transaction;
use Commercetools\Core\Model\Payment\TransactionState;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
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
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $amount = 200;

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentChangeAmountPlannedAction::of()->setAmount(Money::ofCurrencyAndAmount('EUR', $amount))
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($amount, $result->getAmountPlanned()->getCentAmount());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }
// todo migrate Customer missing
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
// todo migrate Customer missing
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
        $client = $this->getApiClient();
        $anonymousId = 'anon-' . PaymentFixture::uniquePaymentString();

        PaymentFixture::withUpdateableDraftPayment(
            $client,
            function (PaymentDraft $draft) use ($anonymousId) {
                return $draft->setAnonymousId($anonymousId);
            },
            function (Payment $payment) use ($client, $anonymousId) {
                $this->assertSame($anonymousId, $payment->getAnonymousId());

                $newAnonymousId = 'new-anon-' . PaymentFixture::uniquePaymentString();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(PaymentSetAnonymousIdAction::of()->setAnonymousId($newAnonymousId));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($newAnonymousId, $result->getAnonymousId());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();
        $key = 'key-' . PaymentFixture::uniquePaymentString();

        PaymentFixture::withUpdateableDraftPayment(
            $client,
            function (PaymentDraft $draft) use ($key) {
                return $draft->setKey($key);
            },
            function (Payment $payment) use ($client, $key) {
                $this->assertSame($key, $payment->getKey());

                $newKey = 'new-key-' . PaymentFixture::uniquePaymentString();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(PaymentSetKeyAction::of()->setKey($newKey));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($newKey, $result->getKey());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetExternalId()
    {
        $client = $this->getApiClient();
        $externalId = 'externalId-' . PaymentFixture::uniquePaymentString();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client, $externalId) {
                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(PaymentSetExternalIdAction::of()->setExternalId($externalId));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($externalId, $result->getExternalId());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetInterfaceId()
    {
        $client = $this->getApiClient();
        $interfaceId = 'interfaceId-' . PaymentFixture::uniquePaymentString();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client, $interfaceId) {
                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(PaymentSetInterfaceIdAction::of()->setInterfaceId($interfaceId));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($interfaceId, $result->getInterfaceId());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetAuthorization()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $authTime = new \DateTime();
                $amount = Money::ofCurrencyAndAmount('EUR', 100);

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetAuthorizationAction::of()
                            ->setAmount($amount)
                            ->setUntil($authTime)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($amount->getCentAmount(), $result->getAmountAuthorized()->getCentAmount());
                $authTime->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame($authTime->format('c'), $result->getAuthorizedUntil()->format('c'));
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetAmountPaid()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $amount = Money::ofCurrencyAndAmount('EUR', 100);

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetAmountPaidAction::of()->setAmount($amount)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($amount->getCentAmount(), $result->getAmountPaid()->getCentAmount());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetAmountRefunded()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $amount = Money::ofCurrencyAndAmount('EUR', 100);

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetAmountRefundedAction::of()->setAmount($amount)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($amount->getCentAmount(), $result->getAmountRefunded()->getCentAmount());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetMethodInfoInterface()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $interface = 'interface-' . PaymentFixture::uniquePaymentString();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetMethodInfoInterfaceAction::of()->setInterface($interface)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($interface, $result->getPaymentMethodInfo()->getPaymentInterface());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetMethodInfoMethod()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $method = 'method-' . PaymentFixture::uniquePaymentString();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetMethodInfoMethodAction::of()->setMethod($method)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($method, $result->getPaymentMethodInfo()->getMethod());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetMethodInfoName()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $name = 'name-' . PaymentFixture::uniquePaymentString();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetMethodInfoNameAction::of()
                            ->setName(LocalizedString::ofLangAndText('en', $name))
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($name, $result->getPaymentMethodInfo()->getName()->en);
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetStatusInterfaceCode()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $code = 'code-' . PaymentFixture::uniquePaymentString();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetStatusInterfaceCodeAction::of()->setInterfaceCode($code)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($code, $result->getPaymentStatus()->getInterfaceCode());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetStatusInterfaceText()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $text = 'text-' . PaymentFixture::uniquePaymentString();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentSetStatusInterfaceTextAction::of()->setInterfaceText($text)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($text, $result->getPaymentStatus()->getInterfaceText());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testTransitionState()
    {
        $client = $this->getApiClient();
        $stateType = 'PaymentState';

        StateFixture::withDraftState(
            $client,
            function (StateDraft $state2Draft) use ($stateType) {
                return $state2Draft->setType($stateType);
            },
            function (State $state2) use ($client, $stateType) {
                StateFixture::withDraftState(
                    $client,
                    function (StateDraft $state1Draft) use ($stateType) {
                        return $state1Draft->setType($stateType);
                    },
                    function (State $state1) use ($client, $state2) {
                        PaymentFixture::withUpdateablePayment(
                            $client,
                            function (Payment $payment) use ($client, $state1, $state2) {
                                $request = RequestBuilder::of()->payments()->update($payment)
                                    ->addAction(
                                        PaymentTransitionStateAction::ofState($state1->getReference())
                                    );
                                $response = $this->execute($client, $request);
                                $result = $request->mapFromResponse($response);
                                $payment = $result;

                                $request = RequestBuilder::of()->payments()->update($payment)
                                    ->addAction(
                                        PaymentTransitionStateAction::ofState($state2->getReference())
                                    );
                                $response = $this->execute($client, $request);
                                $result = $request->mapFromResponse($response);

                                $this->assertInstanceOf(Payment::class, $result);
                                $this->assertSame($state2->getId(), $result->getPaymentStatus()->getState()->getId());
                                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                                return $result;
                            }
                        );
                    }
                );
            }
        );
    }

    public function testTransactions()
    {
        $client = $this->getApiClient();

        PaymentFixture::withUpdateablePayment(
            $client,
            function (Payment $payment) use ($client) {
                $transaction = Transaction::of()
                    ->setType('Authorization')
                    ->setAmount(Money::ofCurrencyAndAmount('EUR', 100))
                    ->setInteractionId($this->getTestRun());

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentAddTransactionAction::of()->setTransaction($transaction)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame(
                    $transaction->getInteractionId(),
                    $result->getTransactions()->current()->getInteractionId()
                );
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                $payment = $result;
                $transaction = $payment->getTransactions()->current();

                $request = RequestBuilder::of()->payments()->update($payment)
                            ->addAction(
                                PaymentChangeTransactionStateAction::of()
                                    ->setTransactionId($transaction->getId())
                                    ->setState(TransactionState::SUCCESS)
                            );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame(TransactionState::SUCCESS, $result->getTransactions()->current()->getState());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                $payment = $result;
                $transaction = $payment->getTransactions()->current();
                $timestamp = new \DateTime();

                $request = RequestBuilder::of()->payments()->update($payment)
                    ->addAction(
                        PaymentChangeTransactionTimestampAction::of()
                            ->setTransactionId($transaction->getId())
                            ->setTimestamp($timestamp)
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $timestamp->setTimezone(new \DateTimeZone('UTC'));
                $this->assertSame(
                    $timestamp->format('c'),
                    $result->getTransactions()->current()->getTimestamp()->getDateTime()->format('c')
                );
                $this->assertNotSame($payment->getVersion(), $result->getVersion());
                $payment = $result;
                $transaction = $payment->getTransactions()->current();

                $interactionId = 'new-' . PaymentFixture::uniquePaymentString();

                $request = PaymentUpdateRequest::ofIdAndVersion($payment->getId(), $payment->getVersion())
                    ->addAction(
                        PaymentChangeTransactionInteractionIdAction::ofTransactionIdAndInteractionId(
                            $transaction->getId(),
                            $interactionId
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $result);
                $this->assertSame($interactionId, $result->getTransactions()->current()->getInteractionId());
                $this->assertNotSame($payment->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAddInterfaceInteraction()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('key-' . TypeFixture::uniqueTypeString())
                    ->setResourceTypeIds(['payment-interface-interaction']);
            },
            function (Type $type) use ($client) {
                PaymentFixture::withUpdateablePayment(
                    $client,
                    function (Payment $payment) use ($client, $type) {
                        $request = RequestBuilder::of()->payments()->update($payment)
                            ->addAction(
                                PaymentAddInterfaceInteractionAction::of()->setType($type->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Payment::class, $result);
                        $this->assertSame(
                            $type->getId(),
                            $result->getInterfaceInteractions()->current()->getType()->getId()
                        );
                        $this->assertNotSame($payment->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testCustomType()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('key-' . TypeFixture::uniqueTypeString())
                    ->setResourceTypeIds(['payment']);
            },
            function (Type $type) use ($client) {
                PaymentFixture::withUpdateablePayment(
                    $client,
                    function (Payment $payment) use ($client, $type) {
                        $request = RequestBuilder::of()->payments()->update($payment)
                            ->addAction(
                                PaymentSetCustomTypeAction::of()->setType($type->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Payment::class, $result);
                        $this->assertSame($type->getId(), $result->getCustom()->getType()->getId());
                        $this->assertNotSame($payment->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }

    public function testCustomField()
    {
        $client = $this->getApiClient();

        TypeFixture::withDraftType(
            $client,
            function (TypeDraft $typeDraft) {
                return $typeDraft->setKey('key-' . TypeFixture::uniqueTypeString())
                    ->setResourceTypeIds(['payment']);
            },
            function (Type $type) use ($client) {
                PaymentFixture::withUpdateablePayment(
                    $client,
                    function (Payment $payment) use ($client, $type) {
                        $request = RequestBuilder::of()->payments()->update($payment)
                            ->addAction(
                                PaymentSetCustomTypeAction::of()->setType($type->getReference())
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $payment = $result;
                        $value = 'value-' . PaymentFixture::uniquePaymentString();

                        $request = RequestBuilder::of()->payments()->update($payment)
                            ->addAction(
                                PaymentSetCustomFieldAction::ofName('testField')->setValue($value)
                            );
                        $response = $this->execute($client, $request);
                        $result = $request->mapFromResponse($response);

                        $this->assertInstanceOf(Payment::class, $result);
                        $this->assertSame($value, $result->getCustom()->getFields()->getTestField());
                        $this->assertNotSame($payment->getVersion(), $result->getVersion());

                        return $result;
                    }
                );
            }
        );
    }
}
