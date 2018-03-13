<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\TaxCategory;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryAddTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryChangeNameAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryRemoveTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryReplaceTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetDescriptionAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetKeyAction;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateByKeyRequest;
use function GuzzleHttp\Psr7\str;

class TaxCategoryUpdateRequestTest extends ApiTestCase
{
    /**
     * @var $name
     * @return TaxCategoryDraft
     */
    protected function getDraft($name)
    {
        $draft = TaxCategoryDraft::ofNameAndRates(
            'test-' . $this->getTestRun() . '-' . $name,
            TaxRateCollection::of()->add(
                TaxRate::of()->setName('test-' . $this->getTestRun() . '-name')
                    ->setAmount(0.2)
                    ->setIncludedInPrice(true)
                    ->setCountry('DE')
                    ->setState($this->getRegion())
            )
        );

        return $draft;
    }

    protected function createTaxCategory(TaxCategoryDraft $draft)
    {
        $request = TaxCategoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $taxCategory = $request->mapResponse($response);

        $this->cleanupRequests[] = $this->deleteRequest = TaxCategoryDeleteRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        );

        return $taxCategory;
    }

    public function testChangeName()
    {
        $draft = $this->getDraft('change-name');
        $taxCategory = $this->createTaxCategory($draft);


        $name = $this->getTestRun() . '-new-name';
        $request = TaxCategoryUpdateRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        )
            ->addAction(TaxCategoryChangeNameAction::ofName($name))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(TaxCategory::class, $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());
    }

    public function testUpdateNameByKey()
    {
        $draft = $this->getDraft('update name')->setKey('key-' . $this->getTestRun());
        $taxCategory = $this->createTaxCategory($draft);

        $name = $this->getTestRun() . '-new-name';
        $request = TaxCategoryUpdateByKeyRequest::ofKeyAndVersion($taxCategory->getKey(), $taxCategory->getVersion())
            ->addAction(TaxCategoryChangeNameAction::ofName($name));

        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(TaxCategory::class, $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());
    }

    public function testSetKey()
    {
        $draft = $this->getDraft('set-key');
        $taxCategory = $this->createTaxCategory($draft);

        $key = $this->getTestRun() . '-new-key';
        $request = TaxCategoryUpdateRequest::ofIdAndVersion($taxCategory->getId(), $taxCategory->getVersion())
            ->addAction(
                TaxCategorySetKeyAction::ofKey($key)
            )
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(TaxCategory::class, $result);
        $this->assertNotSame($key, $draft->getKey());
        $this->assertSame($key, $result->getKey());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());
    }

    public function testSetDescription()
    {
        $draft = $this->getDraft('set-description');
        $taxCategory = $this->createTaxCategory($draft);


        $description = $this->getTestRun() . '-new-description';
        $request = TaxCategoryUpdateRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        )
            ->addAction(TaxCategorySetDescriptionAction::of()->setDescription($description))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(TaxCategory::class, $result);
        $this->assertSame($description, $result->getDescription());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());
    }

    public function testAddRemoveTaxRate()
    {
        $draft = $this->getDraft('add-remove-taxrate');
        $taxCategory = $this->createTaxCategory($draft);


        $taxRate = TaxRate::of()->setName('test-' . $this->getTestRun() . '-rate2')
            ->setAmount(0.3)
            ->setIncludedInPrice(true)
            ->setCountry('DE')
            ->setState('new-' . $this->getRegion());
        $request = TaxCategoryUpdateRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        )
            ->addAction(TaxCategoryAddTaxRateAction::ofTaxRate($taxRate))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(TaxCategory::class, $result);
        $this->assertCount(2, $result->getRates());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());
        $taxCategory = $result;

        $request = TaxCategoryUpdateRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        )
            ->addAction(TaxCategoryRemoveTaxRateAction::ofTaxRateId($result->getRates()->current()->getId()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(TaxCategory::class, $result);
        $this->assertCount(1, $result->getRates());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());
    }

    public function testReplaceTaxRate()
    {
        $draft = $this->getDraft('add-remove-taxrate');
        $taxCategory = $this->createTaxCategory($draft);


        $taxRate = TaxRate::of()->setName('test-' . $this->getTestRun() . '-rate2')
            ->setAmount(0.3)
            ->setIncludedInPrice(true)
            ->setCountry('DE')
            ->setState($this->getRegion());
        $request = TaxCategoryUpdateRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        )
            ->addAction(TaxCategoryReplaceTaxRateAction::ofTaxRateIdAndTaxRate(
                $taxCategory->getRates()->current()->getId(),
                $taxRate
            ))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->deleteRequest->setVersion($result->getVersion());

        $this->assertInstanceOf(TaxCategory::class, $result);
        $this->assertSame($taxRate->getName(), $result->getRates()->current()->getName());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());
    }
}
