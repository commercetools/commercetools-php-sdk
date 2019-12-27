<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\CartDiscount;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\Fixtures\FixtureException;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\Common\LocalizedString;

class CartDiscountCreateRequestTest extends ApiTestCase
{
    public function testCreate()
    {
        $client = $this->getApiClient();

        CartDiscountFixture::withDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'myCategory'));
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->query()
                    ->where('name(en=:name)', ['name' => $cartDiscount->getName()->en]);
                $response = $client->execute($request);
                $result = $request->mapFromResponse($response);

                $this->assertSame($cartDiscount->getName()->en, $result->current()->getName()->en);
                $this->assertSame(
                    $cartDiscount->getValue()->getMoney()->current()->getCentAmount(),
                    $result->current()->getValue()->getMoney()->current()->getCentAmount()
                );
                $this->assertSame(
                    $cartDiscount->getValue()->getMoney()->current()->getCurrencyCode(),
                    $result->current()->getValue()->getMoney()->current()->getCurrencyCode()
                );
                $this->assertSame($cartDiscount->getCartPredicate(), $result->current()->getCartPredicate());
                $this->assertSame($cartDiscount->getTarget()->getType(), $result->current()->getTarget()->getType());
                $this->assertSame(
                    $cartDiscount->getTarget()->getPredicate(),
                    $result->current()->getTarget()->getPredicate()
                );
                $this->assertSame($cartDiscount->getSortOrder(), $result->current()->getSortOrder());
                $this->assertSame($cartDiscount->getIsActive(), $result->current()->getIsActive());
                $this->assertSame(
                    $cartDiscount->getRequiresDiscountCode(),
                    $result->current()->getRequiresDiscountCode()
                );
                $this->assertSame($cartDiscount->getKey(), $result->current()->getKey());
            }
        );
    }

    public function testDeleteByKey()
    {
        $client = $this->getApiClient();

        $this->expectException(FixtureException::class);
        $this->expectExceptionCode(404);

        CartDiscountFixture::withDraftCartDiscount(
            $client,
            function (CartDiscountDraft $draft) {
                return $draft->setName(LocalizedString::ofLangAndText('en', 'delete-by-key'))
                    ->setKey('test-' . $this->getTestRun() . '-delete');
            },
            function (CartDiscount $cartDiscount) use ($client) {
                $request = RequestBuilder::of()->cartDiscounts()->deleteByKey($cartDiscount);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);
                $this->assertInstanceOf(CartDiscount::class, $result);

                $request = RequestBuilder::of()->cartDiscounts()->getByKey($result->getKey());
                $response = $this->execute($client, $request);
                $request->mapFromResponse($response);
            }
        );
    }
}
