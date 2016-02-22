<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

use Commercetools\Core\Model\Common\Context;
use Symfony\Component\Yaml\Yaml;

class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    private static $testRun;
    protected $client;

    protected $cleanupRequests = [];

    public function getTestRun()
    {
        if (is_null(self::$testRun)) {
            self::$testRun = md5(microtime());
        }

        return self::$testRun;
    }

    public function tearDown()
    {
        $this->cleanup();
    }

    /**
     * @return \Commercetools\Core\Client
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            $context = Context::of()->setGraceful(false)->setLanguages(['en'])->setLocale('en_US');
            if (file_exists(__DIR__ . '/../../docroot/myapp.yml')) {
                $appConfig = Yaml::parse(file_get_contents(__DIR__ . '/../../docroot/myapp.yml'));
                $config = $appConfig['parameters'];
            } else {
                $config = Config::fromArray([
                    'client_id' => $_SERVER['COMMERCETOOLS_CLIENT_ID'],
                    'client_secret' => $_SERVER['COMMERCETOOLS_CLIENT_SECRET'],
                    'project' => $_SERVER['COMMERCETOOLS_PROJECT'],
                    'context' => $context
                ]);
            }
            $this->client = new Client($config);
        }

        return $this->client;
    }

    protected function cleanup()
    {
        if (count($this->cleanupRequests) > 0) {
            foreach ($this->cleanupRequests as $request) {
                $this->getClient()->addBatchRequest($request);
            }
            $this->getClient()->executeBatch();
            unset($this->cleanupRequests);
            $this->cleanupRequests = [];
        }
    }

    protected function map(callable $callback, $collection)
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = $callback($item);
        }

        return $result;
    }
}
