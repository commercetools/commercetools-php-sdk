<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created 19.01.15, 14:29
 */

namespace Sphere\Core;


class Client extends AbstractHttpClient
{
    public function submit($request = null)
    {
        $token = $this->getFactory()->getOAuthManager()->getToken();

        $client = $this->getHttpClient();
        $result = $client->get(
            $this->getConfig()->getApiUrl() . '/' . $this->getConfig()->getProject() . '/categories',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token->getToken()
                ]
            ]
        )->json();

        var_dump($result);
    }
}
