<?php

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Request\Me\Command\MyCartAddLineItemAction;
use Commercetools\Core\RequestTestCase;

class MeRequestTest extends RequestTestCase
{
    public function testMyCartAddLineItem()
    {
        $request = MeCartUpdateRequest::ofIdAndVersion('cartId', 1)
            ->addAction(MyCartAddLineItemAction::ofProductIdVariantIdAndQuantity(
                'bla',
                1,
                1
            ));
        $httpRequest = $request->httpRequest();

        $this->assertSame('me/carts/cartId', (string)$httpRequest->getUri());
    }
}
