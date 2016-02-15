<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Product;


use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\Product\ProductDraft;
use Commercetools\Core\Model\ProductType\ProductType;
use Commercetools\Core\Model\ProductType\ProductTypeDraft;
use Commercetools\Core\Request\Products\ProductByIdGetRequest;
use Commercetools\Core\Request\Products\ProductCreateRequest;
use Commercetools\Core\Request\Products\ProductDeleteRequest;
use Commercetools\Core\Request\Products\ProductQueryRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeCreateRequest;
use Commercetools\Core\Request\ProductTypes\ProductTypeDeleteRequest;


class ProductQueryRequestTest extends ApiTestCase
{
    /**
     * @var ProductType
     */
    private $type;

    protected function cleanup()
    {
        parent::cleanup();
        $this->deleteType();
    }


    protected function getType()
    {
        if (is_null($this->type)) {
            $productTypeDraft = ProductTypeDraft::ofNameAndDescription(
                'test-' . $this->getTestRun() . '-productType',
                'test-' . $this->getTestRun() . '-productType'
            );
            $request = ProductTypeCreateRequest::ofDraft($productTypeDraft);
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }

        return $this->type;
    }

    protected function deleteType()
    {
        if (!is_null($this->type)) {
            $request = ProductTypeDeleteRequest::ofIdAndVersion(
                $this->type->getId(),
                $this->type->getVersion()
            );
            $response = $request->executeWithClient($this->getClient());
            $this->type = $request->mapResponse($response);
        }
        $this->type = null;
    }
    
    /**
     * @return ProductDraft
     */
    protected function getDraft()
    {
        $draft = ProductDraft::ofTypeNameAndSlug(
            $this->getType()->getReference(),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product'),
            LocalizedString::ofLangAndText('en', 'test-' . $this->getTestRun() . '-product')
        );

        return $draft;
    }

    protected function createProduct(ProductDraft $draft)
    {
        $request = ProductCreateRequest::ofDraft($draft);
        $response = $request->executeWithClient($this->getClient());
        $product = $request->mapResponse($response);

        $this->cleanupRequests[] = ProductDeleteRequest::ofIdAndVersion(
            $product->getId(),
            $product->getVersion()
        );

        return $product;
    }

    public function testQueryByName()
    {
        $draft = $this->getDraft();
        $product = $this->createProduct($draft);

        $request = ProductQueryRequest::of()->where('masterData(current(name(en="' . $draft->getName()->en . '")))');
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);

        $this->assertCount(1, $result);
        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $result->getAt(0));
        $this->assertSame($product->getId(), $result->getAt(0)->getId());
    }

    public function testQueryById()
    {
        $draft = $this->getDraft();
        $product = $this->createProduct($draft);

        $result = $this->getClient()->execute(ProductByIdGetRequest::ofId($product->getId()))->toObject();

        $this->assertInstanceOf('\Commercetools\Core\Model\Product\Product', $product);
        $this->assertSame($product->getId(), $result->getId());
    }
}

