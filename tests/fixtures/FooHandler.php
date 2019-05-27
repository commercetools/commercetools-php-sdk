<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Fixtures;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Promise;

class FooHandler
{
    private $reply;

    /**
     * FooHandler constructor.
     * @param $reply
     */
    public function __construct($reply)
    {
        $this->reply = $reply;
    }


    public function __invoke(RequestInterface $request, array $options)
    {
        return Promise\promise_for(new Response(200, $request->getHeaders(), $this->reply));
    }
}
