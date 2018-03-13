<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Client\FileUploadRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\StagedTrait;
use Commercetools\Core\Response\ResourceResponse;
use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Response\ApiResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @link https://docs.commercetools.com/http-api-projects-products.html#upload-a-product-image
 * @method Product mapResponse(ApiResponseInterface $response)
 * @method Product mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ProductImageUploadRequest extends AbstractApiRequest
{
    use StagedTrait;

    protected $resultClass = Product::class;

    /**
     * @var UploadedFileInterface
     */
    protected $file;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $variantId;

    /**
     * @var string
     */
    protected $sku;

    /**
     * ProductImageUploadRequest constructor.
     * @param string $id
     * @param UploadedFileInterface $file
     * @param Context|null $context
     */
    public function __construct($id, UploadedFileInterface $file, Context $context = null)
    {
        $this->id = $id;
        $this->file = $file;
        $this->addParamObject(new Parameter('filename', $file->getClientFilename()));

        parent::__construct(ProductsEndpoint::endpoint(), $context);
    }

    public function buildResponse(ResponseInterface $response)
    {
        return new ResourceResponse($response, $this, $this->getContext());
    }

    public function httpRequest()
    {
        return new FileUploadRequest($this->getPath(), $this->file);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId() . '/images' . $this->getParamString();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    protected function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getVariantId()
    {
        return $this->variantId;
    }

    /**
     * @param int $variantId
     * @return $this
     */
    protected function setVariantId($variantId)
    {
        $this->variantId = $variantId;
        $this->addParamObject(new Parameter('variant', $variantId));

        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return $this
     */
    protected function setSku($sku)
    {
        $this->sku = $sku;
        $this->addParamObject(new Parameter('sku', $sku));

        return $this;
    }

    /**
     * @param string $id
     * @param int $variantId
     * @param UploadedFileInterface $file
     * @param Context $context
     * @return ProductImageUploadRequest
     */
    public static function ofIdVariantIdAndFile($id, $variantId, UploadedFileInterface $file, Context $context = null)
    {
        $request = new static($id, $file, $context);
        $request->setVariantId($variantId);
        return $request;
    }

    /**
     * @param string $id
     * @param string $sku
     * @param UploadedFileInterface $file
     * @param Context $context
     * @return ProductImageUploadRequest
     */
    public static function ofIdSkuAndFile($id, $sku, UploadedFileInterface $file, Context $context = null)
    {
        $request = new static($id, $file, $context);
        $request->setSku($sku);
        return $request;
    }
}
