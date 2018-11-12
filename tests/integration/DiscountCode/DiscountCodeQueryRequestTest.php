<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\DiscountCode;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\DiscountCode\DiscountCode;
use Commercetools\Core\Model\DiscountCode\DiscountCodeDraft;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeByIdGetRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeCreateRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeDeleteRequest;
use Commercetools\Core\Request\DiscountCodes\DiscountCodeQueryRequest;

class DiscountCodeQueryRequestTest extends ApiTestCase
{
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

