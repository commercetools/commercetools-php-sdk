<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests\Type;

use Commercetools\Core\Builder\Request\RequestBuilder;
use Commercetools\Core\IntegrationTests\ApiTestCase;
use Commercetools\Core\Model\Type\Type;

class TypeQueryRequestTest extends ApiTestCase
{
    public function testQuery()
    {
        $client = $this->getApiClient();

        TypeFixture::withType(
            $client,
            function (Type $type) use ($client) {
                $request = RequestBuilder::of()->types()->query()
                    ->where('key=:key', ['key' => $type->getKey()]);
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertCount(1, $result);
                $this->assertInstanceOf(Type::class, $result->current());
                $this->assertSame($type->getId(), $result->current()->getId());
            }
        );
    }

    public function testGetById()
    {
        $client = $this->getApiClient();

        TypeFixture::withType(
            $client,
            function (Type $type) use ($client) {
                $request = RequestBuilder::of()->types()->getById($type->getId());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $type);
                $this->assertSame($type->getId(), $result->getId());
            }
        );
    }

    public function testGetByKey()
    {
        $client = $this->getApiClient();

        TypeFixture::withType(
            $client,
            function (Type $type) use ($client) {
                $request = RequestBuilder::of()->types()->getByKey($type->getKey());
                $response = $this->execute($client, $request);
                $result = $request->mapFromResponse($response);

                $this->assertInstanceOf(Type::class, $type);
                $this->assertSame($type->getId(), $result->getId());
                $this->assertSame($type->getKey(), $result->getKey());
            }
        );
    }
}
