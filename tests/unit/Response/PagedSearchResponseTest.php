<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Response;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\BufferStream;
use GuzzleHttp\Subscriber\Mock;
use Sphere\Core\AccessorTrait;
use Sphere\Core\Model\Product\FacetTerm;

/**
 * Class PagedSearchResponseTest
 * @package Sphere\Core\Response
 */
class PagedSearchResponseTest extends \PHPUnit_Framework_TestCase
{
    use AccessorTrait;

    const ABSTRACT_API_REQUEST = '\Sphere\Core\Request\AbstractApiRequest';

    const RESPONSE = '
    {
        "count": 1,
        "total": 1,
        "offset": 1,
        "results": [
            {
                "key": "value"
            }
        ],
        "facets": {
            "variants.attributes.brand": {
                "type": "terms",
                "missing": 10,
                "total": 20,
                "other": 30,
                "terms": [
                    {
                        "term": "myBrand",
                        "count": 1
                    }
                ]
            }
        }
    }';

    /**
     * @return Response
     */
    protected function getGuzzleResponse($response, $statusCode)
    {
        $client = new HttpClient();
        // Create a mock subscriber and queue two responses.
        $mockBody = new BufferStream();
        $mockBody->write($response);

        $mock = new Mock([
            new Response($statusCode, [], $mockBody)
        ]);
        // Add the mock subscriber to the client.
        $client->getEmitter()->attach($mock);

        try {
            $guzzleResponse = $client->get('/');
        } catch (RequestException $exception) {
            $guzzleResponse = $exception->getResponse();
        }

        return $guzzleResponse;
    }

    /**
     * @return PagedSearchResponse
     */
    protected function getResponse($response = null, $statusCode = 200)
    {
        if (is_null($response)) {
            $response = static::RESPONSE;
        }
        $response = new PagedSearchResponse(
            $this->getGuzzleResponse($response, $statusCode),
            $this->getRequest(static::ABSTRACT_API_REQUEST)
        );

        return $response;
    }

    public function testGetFacets()
    {
        $response = $this->getResponse();

        $this->assertInstanceOf('\Sphere\Core\Model\Product\FacetResultCollection', $response->getFacets());
    }

    public function testGetByName()
    {
        $response = $this->getResponse();

        $this->assertInstanceOf(
            '\Sphere\Core\Model\Product\FacetResult',
            $response->getFacets()->getByName('variants.attributes.brand')
        );
    }

    public function testGetFacetType()
    {
        $response = $this->getResponse();

        $this->assertSame(
            'terms',
            $response->getFacets()->getByName('variants.attributes.brand')->getType()
        );
    }

    public function testGetFacetMissing()
    {
        $response = $this->getResponse();

        $this->assertSame(
            10,
            $response->getFacets()->getByName('variants.attributes.brand')->getMissing()
        );
    }

    public function testGetFacetTotal()
    {
        $response = $this->getResponse();

        $this->assertSame(
            20,
            $response->getFacets()->getByName('variants.attributes.brand')->getTotal()
        );
    }

    public function testGetFacetOther()
    {
        $response = $this->getResponse();

        $this->assertSame(
            30,
            $response->getFacets()->getByName('variants.attributes.brand')->getOther()
        );
    }

    public function testGetFacetTerms()
    {
        $response = $this->getResponse();

        $this->assertInstanceOf(
            '\Sphere\Core\Model\Product\FacetTermCollection',
            $response->getFacets()->getByName('variants.attributes.brand')->getTerms()
        );
    }

    public function testGetFacetTerm()
    {
        $response = $this->getResponse();

        $term = $response->getFacets()->getByName('variants.attributes.brand')->getTerms()[0];
        $this->assertInstanceOf(
            '\Sphere\Core\Model\Product\FacetTerm',
            $term
        );
    }

    public function testGetFacetTermValue()
    {
        $response = $this->getResponse();

        /**
         * @var FacetTerm $term
         */
        $term = $response->getFacets()->getByName('variants.attributes.brand')->getTerms()[0];
        $this->assertSame(
            'myBrand',
            $term->getTerm()
        );
    }

    public function testGetFacetTermCount()
    {
        $response = $this->getResponse();

        /**
         * @var FacetTerm $term
         */
        $term = $response->getFacets()->getByName('variants.attributes.brand')->getTerms()[0];
        $this->assertSame(
            1,
            $term->getCount()
        );
    }
}
