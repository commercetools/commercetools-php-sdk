<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Product;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Request\Products\Command\ProductMoveImageToPositionAction;
use Commercetools\Core\Request\Products\Command\ProductRemoveImageAction;
use Commercetools\Core\Request\Products\ProductUpdateRequest;
use GuzzleHttp\Psr7\UploadedFile;

class ProductImageUploadRequestTest extends ApiTestCase
{
    const FILE_NAME = __DIR__ . '/../../fixtures/CT_cube_200px.png';
    const FILE_ALIAS_PATTERN = '/CT-cube-[-_a-zA-Z0-9]*.png/';
    const FILE_ALIAS = 'CT-cube.png';

// todo   introduce a new method in products to upload By Variant ID
    public function testUploadByVariantId()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $fInfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($fInfo, self::FILE_NAME);
                $file = new UploadedFile(
                    self::FILE_NAME,
                    filesize(self::FILE_NAME),
                    UPLOAD_ERR_OK,
                    self::FILE_ALIAS,
                    $mimeType
                );

                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertRegExp(
                    self::FILE_ALIAS_PATTERN,
                    basename(
                        $result->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl()
                    )
                );

                $request = RequestBuilder::of()->products()->update($result)
                    ->addAction(
                        ProductRemoveImageAction::ofVariantIdAndImageUrl(
                            $result->getMasterData()->getStaged()->getMasterVariant()->getId(),
                            $result->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result->getMasterData()->getStaged()->getMasterVariant()->getImages());
            }
        );
    }

    public function testUploadBySku()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $fInfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($fInfo, self::FILE_NAME);

                $file = new UploadedFile(
                    self::FILE_NAME,
                    filesize(self::FILE_NAME),
                    UPLOAD_ERR_OK,
                    self::FILE_ALIAS,
                    $mimeType
                );

                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file
                );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertRegExp(
                    self::FILE_ALIAS_PATTERN,
                    basename(
                        $result->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl()
                    )
                );

                $request = RequestBuilder::of()->products()->update($result)
                    ->addAction(
                        ProductRemoveImageAction::ofSkuAndImageUrl(
                            $result->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                            $result->getMasterData()->getStaged()->getMasterVariant()->getImages()->current()->getUrl()
                        )
                    );
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(0, $result->getMasterData()->getStaged()->getMasterVariant()->getImages());
            }
        );
    }

    public function testImageReorderSamePosition()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $fInfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($fInfo, self::FILE_NAME);

                $file1 = new UploadedFile(self::FILE_NAME, filesize(self::FILE_NAME), UPLOAD_ERR_OK, 'i1', $mimeType);
                $file2 = new UploadedFile(self::FILE_NAME, filesize(self::FILE_NAME), UPLOAD_ERR_OK, 'i2', $mimeType);
                $file3 = new UploadedFile(self::FILE_NAME, filesize(self::FILE_NAME), UPLOAD_ERR_OK, 'i3', $mimeType);

                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file1
                );
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file2
                );
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);
                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file3
                );
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

                $request = RequestBuilder::of()->products()->update($product);
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
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

                $number = 3;
                foreach ($product->getMasterData()->getStaged()->getMasterVariant()->getImages() as $image) {
                    if (preg_match(self::FILE_ALIAS_PATTERN, basename($image->getUrl()), $matches)) {
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
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $this->assertCount(0, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());
            }
        );
    }

    public function testImageReorder()
    {
        $client = $this->getApiClient();

        ProductFixture::withProduct(
            $client,
            function (Product $product) use ($client) {
                $fileAliasPattern = '/([0-9])-[-_a-zA-Z0-9]*.png/';

                $fInfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($fInfo, self::FILE_NAME);

                $file1 = new UploadedFile(self::FILE_NAME, filesize(self::FILE_NAME), UPLOAD_ERR_OK, 'i1', $mimeType);
                $file2 = new UploadedFile(self::FILE_NAME, filesize(self::FILE_NAME), UPLOAD_ERR_OK, 'i2', $mimeType);
                $file3 = new UploadedFile(self::FILE_NAME, filesize(self::FILE_NAME), UPLOAD_ERR_OK, 'i3', $mimeType);

                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file1
                );
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file2
                );
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $request = RequestBuilder::of()->products()->uploadImageBySKU(
                    $product->getId(),
                    $product->getMasterData()->getCurrent()->getMasterVariant()->getSku(),
                    $file3
                );
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

                $request = RequestBuilder::of()->products()->update($product);
                $request->addAction(
                    ProductMoveImageToPositionAction::ofSkuImageAndPosition(
                        $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                        $product->getMasterData()->getStaged()->getMasterVariant()->getImages()->getAt(2)->getUrl(),
                        1
                    )
                );
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $this->assertCount(3, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());

                $images = [];
                foreach ($product->getMasterData()->getStaged()->getMasterVariant()->getImages() as $image) {
                    if (preg_match($fileAliasPattern, basename($image->getUrl()), $matches)) {
                        $images[] = $matches[1];
                    }
                }

                $this->assertSame(['1', '3', '2'], $images);

                $request = RequestBuilder::of()->products()->update($product);
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                foreach ($product->getMasterData()->getStaged()->getMasterVariant()->getImages() as $image) {
                    $request->addAction(
                        ProductRemoveImageAction::ofSkuAndImageUrl(
                            $product->getMasterData()->getStaged()->getMasterVariant()->getSku(),
                            $image->getUrl()
                        )
                    );
                }
                $response = $this->execute($client, $request);
                $product = $request->mapFromResponse($response);

                $this->assertCount(0, $product->getMasterData()->getStaged()->getMasterVariant()->getImages());
            }
        );
    }
}
