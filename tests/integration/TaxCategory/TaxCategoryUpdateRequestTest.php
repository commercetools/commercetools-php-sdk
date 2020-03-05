<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\TaxCategory;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\TaxCategory\TaxCategory;
use Commercetools\Core\Model\TaxCategory\TaxCategoryDraft;
use Commercetools\Core\Model\TaxCategory\TaxRate;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryAddTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryChangeNameAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryRemoveTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategoryReplaceTaxRateAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetDescriptionAction;
use Commercetools\Core\Request\TaxCategories\Command\TaxCategorySetKeyAction;

class TaxCategoryUpdateRequestTest extends ApiTestCase
{
    private function getTaxRate()
    {
        $region = "r" . (string)mt_rand(1, TaxCategoryFixture::RAND_MAX);

        return TaxRate::of()->setName('test-' . TaxCategoryFixture::uniqueTaxCategoryString() . '-rate2')
            ->setAmount(0.3)
            ->setIncludedInPrice(true)
            ->setCountry('DE')
            ->setState('new-' . $region);
    }

    public function testChangeName()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withUpdateableDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $draft) {
                return $draft->setName('change-name');
            },
            function (TaxCategory $taxCategory) use ($client) {
                $name = 'new-name-' . TaxCategoryFixture::uniqueTaxCategoryString();

                $request = RequestBuilder::of()->taxCategories()->update($taxCategory)
                    ->addAction(TaxCategoryChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $result);
                $this->assertSame($name, $result->getName());
                $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testUpdateNameByKey()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withUpdateableDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $draft) {
                return $draft->setName('update name')->setKey('set-test-key');
            },
            function (TaxCategory $taxCategory) use ($client) {
                $name = 'new-name-' . TaxCategoryFixture::uniqueTaxCategoryString();

                $request = RequestBuilder::of()->taxCategories()->update($taxCategory)
                    ->addAction(TaxCategoryChangeNameAction::ofName($name));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $result);
                $this->assertSame($name, $result->getName());
                $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetKey()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withUpdateableDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $draft) {
                return $draft->setKey('set-test-key');
            },
            function (TaxCategory $taxCategory) use ($client) {
                $key = 'new-key-' . TaxCategoryFixture::uniqueTaxCategoryString();

                $request = RequestBuilder::of()->taxCategories()->update($taxCategory)
                    ->addAction(TaxCategorySetKeyAction::ofKey($key));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $result);
                $this->assertNotSame($key, 'set-test-key');
                $this->assertSame($key, $result->getKey());
                $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testSetDescription()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withUpdateableDraftTaxCategory(
            $client,
            function (TaxCategoryDraft $draft) {
                return $draft->setDescription('set-description');
            },
            function (TaxCategory $taxCategory) use ($client) {
                $description = 'new-description-' . TaxCategoryFixture::uniqueTaxCategoryString();

                $request = RequestBuilder::of()->taxCategories()->update($taxCategory)
                    ->addAction(TaxCategorySetDescriptionAction::of()->setDescription($description));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $result);
                $this->assertSame($description, $result->getDescription());
                $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testAddRemoveTaxRate()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withUpdateableTaxCategory(
            $client,
            function (TaxCategory $taxCategory) use ($client) {
                $taxRate = $this->getTaxRate();

                $request = RequestBuilder::of()->taxCategories()->update($taxCategory)
                    ->addAction(TaxCategoryAddTaxRateAction::ofTaxRate($taxRate));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $result);
                $this->assertCount(2, $result->getRates());
                $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

                $taxCategory = $result;
                $request = RequestBuilder::of()->taxCategories()->update($result)
                    ->addAction(TaxCategoryRemoveTaxRateAction::ofTaxRateId($result->getRates()->current()->getId()));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $result);
                $this->assertCount(1, $result->getRates());
                $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }

    public function testReplaceTaxRate()
    {
        $client = $this->getApiClient();

        TaxCategoryFixture::withUpdateableTaxCategory(
            $client,
            function (TaxCategory $taxCategory) use ($client) {
                $taxRate = $this->getTaxRate();

                $request = RequestBuilder::of()->taxCategories()->update($taxCategory)
                    ->addAction(TaxCategoryReplaceTaxRateAction::ofTaxRateIdAndTaxRate(
                        $taxCategory->getRates()->current()->getId(),
                        $taxRate
                    ));
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(TaxCategory::class, $result);
                $this->assertSame($taxRate->getName(), $result->getRates()->current()->getName());
                $this->assertNotSame($taxCategory->getVersion(), $result->getVersion());

                return $result;
            }
        );
    }
}
