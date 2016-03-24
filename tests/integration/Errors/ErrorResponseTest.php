<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Errors;

use Commercetools\Core\ApiTestCase;
use Commercetools\Core\Error\ConcurrentModificationError;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\Categories\CategoryUpdateRequest;
use Commercetools\Core\Request\Categories\Command\CategoryChangeNameAction;

class ErrorResponseTest extends ApiTestCase
{
    public function testConcurrentModification()
    {
        $category = $this->getCategory();

        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())->addAction(
            CategoryChangeNameAction::ofName(
                LocalizedString::ofLangAndText('en', $this->getTestRun() . '-concurrent')
            )
        );
        $response = $request->executeWithClient($this->getClient());
        $result = $request->mapResponse($response);
        $this->category = $result;
        $this->assertFalse($response->isError());

        $request = CategoryUpdateRequest::ofIdAndVersion($category->getId(), $category->getVersion())->addAction(
            CategoryChangeNameAction::ofName(
                LocalizedString::ofLangAndText('en', $this->getTestRun() . '-concurrent 2')
            )
        );
        $response = $request->executeWithClient($this->getClient());

        $this->assertTrue($response->isError());
        $this->assertInstanceOf('\Commercetools\Core\Response\ErrorResponse', $response);
        $error = $response->getErrors()->current();
        $this->assertInstanceOf(
            '\Commercetools\Core\Error\ConcurrentModificationError',
            $error
        );
        $this->assertSame($result->getVersion(), $error->getCurrentVersion());
        $this->assertSame(ConcurrentModificationError::CODE, $error->getCode());
    }
}
