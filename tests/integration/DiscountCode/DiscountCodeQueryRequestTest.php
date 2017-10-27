<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\DiscountCode;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\CartDiscount\CartDiscount;
use Commercetools\Core\Model\CartDiscount\CartDiscountDraft;
use Commercetools\Core\Model\CartDiscount\CartDiscountReferenceCollection;
use Commercetools\Core\Model\CartDiscount\CartDiscountTarget;
use Commercetools\Core\Model\CartDiscount\CartDiscountValue;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Common\Money;
use Commercetools\Core\Model\Common\MoneyCollection;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Request\CartDiscounts\CartDiscountCreateRequest;
use Commercetools\Core\Request\CartDiscounts\CartDiscountDeleteRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeQueryRequest;

class DiscountCodeQueryRequestTest extends ApiTestCase
{
    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteCartDiscount();
    }


    protected function deleteCartDiscount()
    {
        if (!is_null($this->cartDiscount)) {
            $request = CartDiscountDeleteRequest::ofIdAndVersion(
                $this->cartDiscount->getId(),
                $this->cartDiscount->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->cartDiscount = $request->mapResponse($response);
        }
        $this->cartDiscount = null;
    }

    /**
     * @return DiscountCodeDraft
     */
    protected function getDraft()
    {
        return $this->getDiscountCodeDraft()->setIsActive(false);
    }

    protected function createDiscountCode(DiscountCodeDraft $draft)
    {
        $request = DiscountCodeCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $discountCode = $request->mapResponse($response);

        $this->cleanupRequests[] = DiscountCodeDeleteRequest::ofIdAndVersion(
            $discountCode->getId(),
            $discountCode->getVersion()
        );

        return $discountCode;
    }

    public function testQuery()
    {
        $draft = $this->getDraft();
        $discountCode = $this->createDiscountCode($draft);

        $request = DiscountCodeQueryRequest::of()->where('code="' . $draft->getCode() . '"');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(DiscountCode::class, $result->getAt(0));
        $this->assertSame($discountCode->getId(), $result->getAt(0)->getId());
    }

    public function testGetById()
    {
        $draft = $this->getDraft();
        $discountCode = $this->createDiscountCode($draft);

        $request = DiscountCodeByIdGetRequest::ofId($discountCode->getId());
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf(DiscountCode::class, $discountCode);
        $this->assertSame($discountCode->getId(), $result->getId());
    }
}

