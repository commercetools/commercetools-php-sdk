<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Product;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Request\Products\Command\ProductMoveImageToPositionAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveImageAction;
use Commercetools\Core\Request\Products\ProductImageUploadRequest;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use GuzzleHttp\Psr7\UploadedFile;

class ProductImageUploadRequestTest extends ApiTestCase
{
    public function testUploadByVariantId()
    {
        $product = $this->getProduct();

        $fileName = __DIR__ . '/../../fixtures/CT_cube_200px.png';
        $fileAlias = 'CT-cube.png';
        $fileAliasPattern = '/CT-cube-[-_a-zA-Z0-9]*.png/';

        $fInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fInfo, $fileName);

        $file = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, $fileAlias, $mimeType);

        $request = ProductImageUploadRequest::ofIdVariantIdAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getId(),
            $file
        );

        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);
        $this->assertRegExp(
            $fileAliasPattern,
            basename($product->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl())
        );
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->addAction(
            ProductRemoveImageAction::ofVariantIdAndImageUrl(
                $product->getMasterData()->getStaged()->getMasterVariant()->getId(),
                $product->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl()
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);
        $this->assertCount(0, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());
    }

    public function testUploadBySku()
    {
        $product = $this->getProduct();

        $fileName = __DIR__ . '/../../fixtures/CT_cube_200px.png';
        $fileAlias = 'CT-cube.png';
        $fileAliasPattern = '/CT-cube-[-_a-zA-Z0-9]*.png/';

        $fInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fInfo, $fileName);

        $file = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, $fileAlias, $mimeType);

        $request = ProductImageUploadRequest::ofIdSkuAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            $file
        );

        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);
        $this->assertRegExp(
            $fileAliasPattern,
            basename($product->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl())
        );
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->addAction(
            ProductRemoveImageAction::ofSkuAndImageUrl(
                $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                $product->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl()
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);
        $this->assertCount(0, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());
    }

    public function testImageReorderSamePosition()
    {
        $product = $this->getProduct();

        $fileName = __DIR__ . '/../../fixtures/CT_cube_200px.png';
        $fileAliasPattern = '/([0-9])-[-_a-zA-Z0-9]*.png/';

        $fInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fInfo, $fileName);

        $file1 = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, 'i1', $mimeType);
        $file2 = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, 'i2', $mimeType);
        $file3 = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, 'i3', $mimeType);

        $request = ProductImageUploadRequest::ofIdSkuAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            $file1
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $request = ProductImageUploadRequest::ofIdSkuAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            $file2
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $request = ProductImageUploadRequest::ofIdSkuAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            $file3
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->addAction(
            ProductMoveImageToPositionAction::ofSkuImageAndPosition(
                $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                $product->getMasterData()->getStaged()->getMasterVariant()->getImages()->getAt(1)->getUrl(),
                0
            )
        )->addAction(
            ProductMoveImageToPositionAction::ofSkuImageAndPosition(
                $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                $product->getMasterData()->getStaged()->getMasterVariant()->getImages()->getAt(2)->getUrl(),
                0
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

        $number = 3;
        foreach ($product->getMasterData()->getStaged()->getMasterVariant()->getImages() as $image) {
            if (preg_match($fileAliasPattern, basename($image->getUrl()), $matches)) {
                $this->assertSame((string)$number, $matches[1]);
                $number--;
            }
        }

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        foreach ($product->getMasterData()->getStaged()->getMasterVariant()->getImages() as $image) {
            $request->addAction(
                ProductRemoveImageAction::ofSkuAndImageUrl(
                    $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                    $image->getUrl()
                )
            );
        }
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);
        $this->assertCount(0, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());
    }

    public function testImageReorder()
    {
        $product = $this->getProduct();

        $fileName = __DIR__ . '/../../fixtures/CT_cube_200px.png';
        $fileAliasPattern = '/([0-9])-[-_a-zA-Z0-9]*.png/';

        $fInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fInfo, $fileName);

        $file1 = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, 'i1', $mimeType);
        $file2 = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, 'i2', $mimeType);
        $file3 = new UploadedFile($fileName, filesize($fileName), UPLOAD_ERR_OK, 'i3', $mimeType);

        $request = ProductImageUploadRequest::ofIdSkuAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            $file1
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $request = ProductImageUploadRequest::ofIdSkuAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            $file2
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $request = ProductImageUploadRequest::ofIdSkuAndFile(
            $product->getId(), $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
            $file3
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        $request->addAction(
            ProductMoveImageToPositionAction::ofSkuImageAndPosition(
                $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                $product->getMasterData()->getStaged()->getMasterVariant()->getImages()->getAt(2)->getUrl(),
                1
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);

        $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

        $images = [];
        foreach ($product->getMasterData()->getStaged()->getMasterVariant()->getImages() as $image) {
            if (preg_match($fileAliasPattern, basename($image->getUrl()), $matches)) {
                $images[] = $matches[1];
            }
        }

        $this->assertSame(['1', '3', '2'], $images);
        $request = ProductUpdateRequest::ofIdAndVersion($product->getId(), $product->getVersion());
        foreach ($product->getMasterData()->getStaged()->getMasterVariant()->getImages() as $image) {
            $request->addAction(
                ProductRemoveImageAction::ofSkuAndImageUrl(
                    $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                    $image->getUrl()
                )
            );
        }
        $response = $request->executeWithClient($this->getClient());
        $this->product = $product = $request->mapResponse($response);
        $this->assertCount(0, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());
    }
}
