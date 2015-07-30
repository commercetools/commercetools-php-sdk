<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

use Commercetools\Core\Model\Common\Context;

class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected $cleanupRequests = [];

    protected function cleanup()
    {
        if (count($this->cleanupRequests) > 0) {
            foreach ($this->cleanupRequests as $request) {
                $this->getClient()->addBatchRequest($request);
            }
            $this->getClient()->executeBatch();
            $this->cleanupRequests = [];
        }
    }

    public function tearDown()
    {
        $this->cleanup();
    }

    protected function map(callable $callback, $collection)
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = $callback($item);
        }

        return $result;
    }
    /**
     * @return \Commercetools\Core\Client
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            $context = Context::of()->setGraceful(false)->setLanguages(['en'])->setLocale('en_US');
            if (file_exists(__DIR__ . '/myapp.ini')) {
                $appConfig = parse_ini_file(__DIR__ . '/myapp.ini', true);
                $config = $appConfig['sphere'];
            } else {
                $config = Config::fromArray([
                    'client_id' => $_SERVER['SPHERE_CLIENT_ID'],
                    'client_secret' => $_SERVER['SPHERE_CLIENT_SECRET'],
                    'project' => $_SERVER['SPHERE_PROJECT'],
                    'context' => $context
                ]);
            }
            $this->client = new Client($config);
        }

        return $this->client;
    }
}
