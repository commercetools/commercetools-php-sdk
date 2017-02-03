<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Commons\Helper;


use Commercetools\Core\Client;
use Commercetools\Core\Request\QueryAllRequestInterface;

class QueryHelper
{
    const DEFAULT_PAGE_SIZE = 500;

    public function getAll(Client $client, QueryAllRequestInterface $request)
    {
        $lastId = null;
        $data = ['results' => []];
        do {
            $request->sort('id')->limit(static::DEFAULT_PAGE_SIZE)->withTotal(false);
            if ($lastId != null) {
                $request->where('id > "' . $lastId . '"');
            }
            $response = $client->execute($request);
            if ($response->isError() || is_null($response->toObject())) {
                break;
            }
            $results = $response->toArray()['results'];
            $data['results'] = array_merge($data['results'], $results);
            $lastId = end($results)['id'];
        } while (count($results) >= static::DEFAULT_PAGE_SIZE);

        $result = $request->mapResult($data, $client->getConfig()->getContext());

        return $result;
    }
}
