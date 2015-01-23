<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


use Sphere\Core\Http\ClientRequest;
use Sphere\Core\Model\Category\Query\CategoryQuery;

class Client extends AbstractHttpClient
{
    protected function getBaseUrl()
    {
        return $this->getConfig()->getApiUrl() . '/' . $this->getConfig()->getProject() . '/';
    }

    public function execute(ClientRequest $request)
    {
        $request = CategoryQuery::of();

        $token = $this->getFactory()->getOAuthManager()->getToken();

        $client = $this->getHttpClient();
        $method = $request->httpRequest()->getHttpMethod();
        $headers = [
            'Authorization' => 'Bearer ' . $token->getToken()
        ];

        $options = [
            'headers' => $headers,
            'body' => $request->httpRequest()->getBody()
        ];

        $httpRequest = $client->createRequest($method, $request->httpRequest()->getPath(), $options);
        $result = $client->send($httpRequest)->json();

        var_dump($result);
    }
}
