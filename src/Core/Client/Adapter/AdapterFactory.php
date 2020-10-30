<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use GuzzleHttp\Client;
use Commercetools\Core\Error\InvalidArgumentException;
use GuzzleHttp\ClientInterface;

class AdapterFactory
{
    protected $adapters = [];

    public function __construct()
    {
        $this->register('guzzle5', Guzzle5Adapter::class)
            ->register('guzzle6', Guzzle6Adapter::class);
    }

    /**
     * @param string $name
     * @param string $adapterClass
     * @return $this
     */
    public function register($name, $adapterClass)
    {
        $this->adapters[$name] = $adapterClass;

        return $this;
    }

    /**
     * @internal
     * @param string $name
     * @return string
     */
    public function getClass($name = null)
    {
        if (is_null($name)) {
            $name = "guzzle6";
            if (defined('\GuzzleHttp\Client::VERSION') && version_compare(constant('\GuzzleHttp\Client::VERSION'), '6.0.0', '<')) {
                $name = 'guzzle5';
            }
        }
        if (isset($this->adapters[$name])) {
            return $this->adapters[$name];
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param $name
     * @param $options
     * @return AdapterInterface
     */
    public function getAdapter($name, $options)
    {
        $adapterClass = $this->getClass($name);
        $adapter = new $adapterClass($options);

        return $adapter;
    }
}
