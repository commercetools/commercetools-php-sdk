<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\TaxCategory;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Model\TaxCategory\TaxRateCollection;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryAddTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryChangeNameAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryRemoveTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryReplaceTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetDescriptionAction;
use Commercetools\Core\Request\TaxCategories\TaxCategoryCreateRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryDeleteRequest;
use Commercetools\Core\Request\TaxCategories\TaxCategoryUpdateRequest;

class TaxCategoryUpdateRequestTest extends ApiTestCase
{
    private $state;

    private function getState()
    {
        if (is_null($this->state)) {
            $this->state = (string)mt_rand(1, 1000);
        }

        return $this->state;
    }

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
                    ->setState($this->getState())
            )
        );

        return $draft;
    }

    protected function createTaxCategory(TaxCategoryDraft $draft)
    {
        $request = TaxCategoryCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $taxCategory = $request->mapResponse($response);

        $this->cleanupRequests[] = TaxCategoryDeleteRequest::ofIdAndVersion(
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

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
        $this->assertSame($name, $result->getName());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
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

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
        $this->assertSame($description, $result->getDescription());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
    }

    public function testAddRemoveTaxRate()
    {
        $draft = $this->getDraft('add-remove-taxrate');
        $taxCategory = $this->createTaxCategory($draft);


        $taxRate = TaxRate::of()->setName('test-' . $this->getTestRun() . '-rate2')
            ->setAmount(0.3)
            ->setIncludedInPrice(true)
            ->setCountry('DE')
            ->setState($this->getState());
        $request = TaxCategoryUpdateRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        )
            ->addAction(TaxCategoryAddTaxRateAction::ofTaxRate($taxRate))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $actualVersion = $result->getVersion();

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
        $this->assertCount(2, $result->getRates());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

        $request = TaxCategoryUpdateRequest::ofIdAndVersion(
            $taxCategory->getId(),
            $taxCategory->getVersion()
        )
            ->addAction(TaxCategoryRemoveTaxRateAction::ofTaxRateId($result->getRates()->current()->getId()))
        ;
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
        $this->assertCount(1, $result->getRates());
        $this->assertNotSame($actualVersion, $result->getVersion());


        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
    }

    public function testReplaceTaxRate()
    {
        $draft = $this->getDraft('add-remove-taxrate');
        $taxCategory = $this->createTaxCategory($draft);


        $taxRate = TaxRate::of()->setName('test-' . $this->getTestRun() . '-rate2')
            ->setAmount(0.3)
            ->setIncludedInPrice(true)
            ->setCountry('DE')
            ->setState($this->getState());
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

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
        $this->assertSame($taxRate->getName(), $result->getRates()->current()->getName());
        $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

        $deleteRequest = array_pop($this->cleanupRequests);
        $deleteRequest->setVersion($result->getVersion());
        $result = $this->getClient()->execute($deleteRequest)->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\TaxCategory\TaxCategory', $result);
    }
}
