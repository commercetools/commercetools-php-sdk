<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Payment;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Payment\Payment;
use Commercetools\Core\Model\Payment\PaymentDraft;

class PaymentQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        PaymentFixture::withPayment(
            $client,
            function (Payment $payment) use ($client) {
                $request = RequestBuilder::of()->payments()->query()
                    ->where('key=:key', ['key' => $payment->getKey()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Payment::class, $result->current());
                $this->assertSame($payment->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();
        $key = 'key-' . PaymentFixture::uniquePaymentString();

        PaymentFixture::withDraftPayment(
            $client,
            function (PaymentDraft $draft) use ($key) {
                return $draft->setKey($key);
            },
            function (Payment $payment) use ($client, $key) {
                $request = RequestBuilder::of()->payments()->getByKey($key);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $payment);
                $this->assertSame($payment->getId(), $result->getId());
                $this->assertSame($key, $result->getKey());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        PaymentFixture::withPayment(
            $client,
            function (Payment $payment) use ($client) {
                $request = RequestBuilder::of()->payments()->getById($payment->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Payment::class, $payment);
                $this->assertSame($payment->getId(), $result->getId());
            }
        );
    }
}
