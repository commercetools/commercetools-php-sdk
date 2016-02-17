<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Payment;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;
use Commercetools\Core\Model\Payment\PaymentMethodInfo;
use Commercetools\Core\Request\Payments\PaymentByIdGetRequest;
use Commercetools\Core\Request\Payments\PaymentCreateRequest;
use Commercetools\Core\Request\Payments\PaymentDeleteRequest;
use Commercetools\Core\Request\Payments\PaymentQueryRequest;

class PaymentQueryRequestTest extends ApiTestCase
{
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

        $this->cleanupRequests[] = PaymentDeleteRequest::ofIdAndVersion(
            $payment->getId(),
            $payment->getVersion()
        );

        return $payment;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $result = $this->getClient()->execute(
            PaymentQueryRequest::of()->where('externalId="' . $draft->getExternalId() . '"')
        )->toObject();

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $result->getAt(0));
        $this->assertSame($payment->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $payment = $this->createPayment($draft);

        $request = PaymentByIdGetRequest::ofId($payment->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\Payment\Payment', $payment);
        $this->assertSame($payment->getId(), $result->getId());

    }
}
