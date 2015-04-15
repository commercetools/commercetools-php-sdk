<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core;

use Sphere\Core\Model\Common\Context;

class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function cleanup()
    {

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
     * @return \Sphere\Core\Client
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            $context = Context::of()->setGraceful(false)->setLanguages(['en'])->setLocale('en_US');
            $config = [
                'client_id' => $_SERVER['SPHERE_CLIENT_ID'],
                'client_secret' => $_SERVER['SPHERE_CLIENT_SECRET'],
                'project' => $_SERVER['SPHERE_PROJECT'],
                'context' => $context
            ];
            $this->client = new Client($config);
        }

        return $this->client;
    }
}
