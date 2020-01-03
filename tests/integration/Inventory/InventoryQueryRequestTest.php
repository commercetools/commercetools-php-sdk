<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Inventory;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Inventory\InventoryEntry;

class InventoryQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        InventoryFixture::withInventory(
            $client,
            function (InventoryEntry $inventory) use ($client) {
                $request = RequestBuilder::of()->inventory()->query()
                    ->where('sku=:sku', ['sku' => $inventory->getSku()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(InventoryEntry::class, $result->current());
                $this->assertSame($inventory->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        InventoryFixture::withInventory(
            $client,
            function (InventoryEntry $inventory) use ($client) {
                $request = RequestBuilder::of()->inventory()->getById($inventory->getId());

                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(InventoryEntry::class, $inventory);
                $this->assertSame($inventory->getId(), $result->getId());
            }
        );
    }
}
